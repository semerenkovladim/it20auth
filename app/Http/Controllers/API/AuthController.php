<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\ClearCodeReset;
use App\Mail\SuspiciousMail;
use App\Mail\TwoStepCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function baseAuth(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        $user = User::whereEmail($validated['email'])->with(['department', 'access_level', 'backup_date', 'setting', 'history_visits'])->first();

        if (!$user) {
            return response()->json([], 404);
        }

        // Если пользователь с таким email адресом найден - проверим совпадает
        // ли его пароль с указанным
        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([], 422);
        }

        if($user->setting->useTwoStepAuth) {
            return response()->json([], 403);
        }

        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $validated['email'],
            'password' => $validated['password'],
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        // Проверяем был ли внутренний запрос успешным
        if ($response->getStatusCode() != 200) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

        if($user->ip) {
            if($user->setting->suspiciousLoginNotifications && $user->getIp() !== $user->ip) {
                Mail::to($user->email)->send(new SuspiciousMail($user->name));
            }
        } else {
            $user->ip = $user->getIp();
            $user->save();
        }
        // Вытаскиваем данные из ответа
        $data = json_decode($response->getContent(), true);
        // Формируем окончательный ответ в нужном формате
        return response()->json([
            'token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'user' => $user,
            'status' => 200
        ]);
    }

    public function createAuthCode(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        $user = User::whereEmail($validated['email'])->first();

        $code = Str::random('6');
        Mail::to($user->email)->send(new TwoStepCode($code, $user->name));
        $user->twostep_code = $code;

        $user->save();

        ClearCodeReset::dispatch($user)->delay(now()->addMinutes(20));

        return response()->json([], 200);
    }

    public function loginWithCode(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
            'twostep_code' => 'required'
        ]);

        $user = User::whereEmail($validated['email'])->with(['department', 'access_level', 'backup_date', 'setting', 'history_visits'])->first();

        if (!$user) {
            return response()->json([], 422);
        }

        // Если пользователь с таким email адресом найден - проверим совпадает
        // ли его пароль с указанным
        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([], 422);
        }

        if($validated['twostep_code'] !== $user->twostep_code) {
            return response()->json([], 403);
        }

        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $validated['email'],
            'password' => $validated['password'],
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        // Проверяем был ли внутренний запрос успешным
        if ($response->getStatusCode() != 200) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }
        if($user->ip) {
            if($user->setting->suspiciousLoginNotifications && $request->ip() !== $user->ip) {
                Mail::to($user->email)->send(new SuspiciousMail($user->name));
            }
        } else {
            $user->ip = $request->ip();
            $user->save();
        }

        // Вытаскиваем данные из ответа
        $data = json_decode($response->getContent(), true);

        $user->twostep_code = null;

        $user->save();

        // Формируем окончательный ответ в нужном формате
        return response()->json([
            'token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'user' => $user,
            'status' => 200
        ]);
    }

    public function logout()
    {
        $accessToken = auth()->user()->token();

        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return response()->json(['status' => 200]);
    }

    public function loginWithPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
            'reservedPassword' => 'required'
        ]);

        $user = User::whereEmail($validated['email'])->with(['department', 'access_level', 'backup_date', 'setting', 'history_visits'])->first();

        if (!$user) {
            return response()->json([], 422);
        }

        // Если пользователь с таким email адресом найден - проверим совпадает
        // ли его пароль с указанным
        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([], 422);
        }

        if(!Hash::check($validated['reservedPassword'], $user->backup_date->backup_password) || !$user->setting->useReservedPassword) {
            return response()->json([], 403);
        }

        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $validated['email'],
            'password' => $validated['password'],
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        // Проверяем был ли внутренний запрос успешным
        if ($response->getStatusCode() != 200) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

        // Вытаскиваем данные из ответа
        $data = json_decode($response->getContent(), true);

        if($user->ip) {
            if($user->setting->suspiciousLoginNotifications && $request->ip() !== $user->ip) {
                Mail::to($user->email)->send(new SuspiciousMail($user->name));
            }
        } else {
            $user->ip = $request->ip();
            $user->save();
        }

        // Формируем окончательный ответ в нужном формате
        return response()->json([
            'token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'user' => $user,
            'status' => 200
        ]);
    }

    public function checkSecret(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users',
        ]);

        $user = User::whereEmail($validated['email'])->with(['setting'])->first();

        if($user->setting->useCodeWord) {
            return response()->json([], 200);
        }

        return response()->json([], 404);
    }

    public function checkReservedEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users',
        ]);

        $user = User::whereEmail($validated['email'])->with(['backup_date'])->first();

        if($user->backup_date->backup_email)
        {
            return response()->json($user->backup_date->backup_email, 200);
        }
    }
}

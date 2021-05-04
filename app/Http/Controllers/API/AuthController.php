<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function baseAuth(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
            'reservedPassword' => 'min:6|max:16',
            'code' => ''
        ]);

        $user = User::whereEmail($validated['email'])->with(['department', 'access_level', 'backup_date', 'setting'])->first();

        if (!$user) {
            return response()->json([], 422);
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
}

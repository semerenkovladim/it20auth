<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\ClearCodeReset;
use App\Mail\ResetPasswordCode;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
Session::start();

class ResetPasswordController extends Controller
{

    protected function checkRecaptcha($token, $ip)
    {
        $data = [
            'form_params' => [
                'secret'   => env('RECAPTCHA_SECRET'),
                'response' => $token,
                'remoteip' => $ip,
            ],
        ];
        $request = Request::create('https://www.google.com/recaptcha/api/siteverify', 'POST', $data);
        $response = app()->handle($request);
        return $response;
    }

    public function createCode($email) {
        $code = Str::random('6');
        $user = User::whereEmail($email)->first();

        Mail::to($user->email)->send(new ResetPasswordCode($code, $user->name));
        $user->code = $code;

        ClearCodeReset::dispatch($user)->delay(now()->addMinutes(20));

        return $user;
    }

    public function sendCode(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users',
            'recaptchaToken' => 'required'
        ]);
        if(!$this->checkRecaptcha($validated['recaptchaToken'], $request->ip()))
        {
            return response()->json([
                'error' => 'Captcha is invalid.',
            ], 401);
        }

        $user = $this->createCode($validated['email']);

        $user->save();

        return response()->json([], 200);
    }

    public function resetPasswordCode(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
            'email' => 'required|exists:users'
        ]);

        $user = User::whereEmail($validated['email'])->first();

        if($validated['code'] !== $user->code)
        {
            return response()->json([], 404);
        }

        $user->allow_reset = true;
        $user->save();

        return response()->json([], 200);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|min:6',
            'email' => 'required|exists:users'
        ]);

        $user = User::whereEmail($validated['email'])->first();
        if(!$user->allow_reset) {
            return response()->json([], 404);
        }
        $user->password = Hash::make($validated['password']);
        $user->code = null;
        $user->allow_reset = false;
        $user->save();

        return response()->json([], 200);
    }

    public function resendPasswordCode(Request $request) {
        $validated = $request->validate([
            'email' => 'required|exists:users',
        ]);

        $user = $this->createCode($validated['email']);

        $user->save();

        return response()->json([], 200);
    }
}

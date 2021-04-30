<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpseclib3\Crypt\Random;

class ResetPasswordController extends Controller
{
    private $email;
    private $code;
    private $allowReset;

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
        $response = json_decode((string)$response->getBody(), true);
        return $response['success'];
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

        $this->email = $validated['email'];
        $this->code = Random::string('6');
        $user = User::whereEmail($this->email)->first();

        Mail::to($request->user())->send(new ResetPasswordCode($this->code, $user->name));

        return response()->json([], 200);
    }

    public function resetPasswordCode(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required'
        ]);

        if($validated['code'] !== $this->code)
        {
            $this->allowReset = false;
            return response()->json([], 404);
        }
        $this->allowReset = false;

        return response()->json([], 200);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|min:6',
            'email' => 'required|exists:users'
        ]);

        if($validated['email'] !== $this->email) {
            return response()->json([], 404);
        }

        $user = User::whereEmail($validated['email'])->first();

        $user->password = $validated['password'];
        $user->save();

        return response()->json([], 200);
    }


}

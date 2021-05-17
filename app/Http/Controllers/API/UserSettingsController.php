<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendReservedPassword;
use App\Models\BackupData;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserSettingsController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'twoFactor' => 'bool',
            'reservedPassword' => 'bool',
            'useCode' => 'bool',
            'codeWord' => 'string',
            'reservedEmail' => 'string|nullable',
            'password' => 'min:6|max:16|nullable'
        ]);

        $userAuth = $request->user();
        $user = User::find($userAuth->id);
        $setting = Setting::find($user->setting->id);
        $backup = BackupData::find($user->backup_date->id);


        if(array_key_exists('twoFactor', $validated)) {
            $setting->useTwoStepAuth = $validated['twoFactor'];
        }

        if(array_key_exists('reservedPassword', $validated)) {
            if(boolval($validated['reservedPassword']) !== boolval($setting->useReservedPassword)) {
                if (boolval($validated['reservedPassword'])) {
                    $reservedPassword = Str::random(4) . mt_rand(10, 99);
                    Mail::to($user->email)->send(new SendReservedPassword($reservedPassword, $user->name));

                    $backup->backup_password = Hash::make($reservedPassword);

                }
                $setting->useReservedPassword = $validated['reservedPassword'];
            }
        }

        if(array_key_exists('useCode', $validated)) {
            $setting->useCodeWord = $validated['useCode'];
            if(array_key_exists('codeWord', $validated)) {
                $backup->code_word = $validated['codeWord'];
            }
        }

        if(array_key_exists('reservedEmail', $validated)) {
            $backup->backup_email = $validated['reservedEmail'];
        }

        if(array_key_exists('password', $validated)) {
            $user->password = Hash::make($validated['password']);
            $user->save();
            $user->refresh();
        }
        $user->setting()->save($setting);
        $user->backup_date()->save($backup);
        $user->refresh();

        return response()->json($user, 200);
    }
}

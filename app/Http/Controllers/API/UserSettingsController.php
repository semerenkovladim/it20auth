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
            'twoFactor' => 'required|bool',
            'reservedPassword' => 'required|bool'
        ]);

        $userAuth = $request->user();
        $user = User::find($userAuth->id);
        $setting = Setting::find($user->setting->id);
        $setting->useTwoStepAuth = $validated['twoFactor'];
        if(boolval($validated['reservedPassword']) !== boolval($setting->useReservedPassword)) {
            if(boolval($validated['reservedPassword'])) {
                $reservedPassword = Str::random(4) . mt_rand(10, 99);
                Mail::to($user->email)->send(new SendReservedPassword($reservedPassword, $user->name));

                $backup = BackupData::find($user->backup_date->id);
                $backup->backup_password = Hash::make($reservedPassword);

                $user->backup_date()->save($backup);
            }
            $setting->useReservedPassword = $validated['reservedPassword'];
        }
        $user->setting()->save($setting);
        $user->refresh();

        return response()->json($user, 200);
    }
}

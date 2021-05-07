<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function store(Request $request)
    {
        $userId = $request->user_id;
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['data' => $user, 'status' => false]);
        }

        $userSetting = Setting::make();
        $userSetting->useTwoStepAuth = false;
        $userSetting->useReservedPassword = false;
        $userSetting->suspiciousLoginNotifications = false;
        $userSetting->useCodeWord = false;
        $userSetting->user_id = $userId;
        $userSetting->save();

        return response()->json(['data' => $userSetting, 'status' => true]);
    }
}

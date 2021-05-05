<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'twoFactor' => 'required|bool'
        ]);

        $userAuth = $request->user();
        $user = User::find($userAuth->id);
        $setting = Setting::find($user->setting->id);
        $setting->useTwoStepAuth = $validated['twoFactor'];
        $user->setting()->save($setting);

        return response()->json($user, 200);
    }
}

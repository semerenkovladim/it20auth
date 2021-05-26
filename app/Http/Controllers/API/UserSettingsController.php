<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendReservedPassword;
use App\Models\ActionRecentModel;
use App\Models\BackupData;
use App\Models\ModifyCodeword;
use App\Models\ModifyNotification;
use App\Models\ModifyPassword;
use App\Models\ModifyReservedEmail;
use App\Models\ModifyReservedPassword;
use App\Models\ModifyTwostep;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class UserSettingsController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'twofactor' => 'bool',
            'reservedPassword' => 'bool',
            'useCode' => 'bool',
            'codeWord' => 'string',
            'password' => 'string',
            'reservedEmail' => 'string|nullable',
            'suspiciousLoginNotifications' => 'bool'
        ]);
        $location = Location::get();
        $userAuth = $request->user();
        $user = User::with(['action_recent', 'setting', 'backup_date', 'access_level'])->find($userAuth->id);
        $setting = Setting::where('user_id', $user->id)->first();
        $backup = BackupData::where('user_id', $user->id)->first();
        $actionResent = ActionRecentModel::where('user_id', $user->id)
            ->with(['modify_password', 'modify_twostep', 'modify_reserved_password', 'modify_reserved_email', 'modify_notification', 'modify_codeword'])
            ->first();
        if(! $actionResent) {
            $actionResent = new ActionRecentModel();
        }
        if(array_key_exists('twofactor', $validated)) {
            $setting->useTwoStepAuth = $validated['twofactor'];
            if($actionResent->modify_twostep_id) {
                $modifyTwostep = ModifyTwostep::find($actionResent->modify_twostep_id);
                $modifyTwostep->city = $location->cityName;
                $modifyTwostep->state = $location->regionName;
                $modifyTwostep->country = $location->countryName;
                $modifyTwostep->date = Carbon::now();
                $modifyTwostep->time = Carbon::now()->toTimeString();
                if($validated['twofactor']) {
                    $modifyTwostep->action = 'Включена';
                } else {
                    $modifyTwostep->action = 'Выключена';
                }
            } else {
                $modifyTwostep = new ModifyTwostep();
                $modifyTwostep->city = $location->cityName;
                $modifyTwostep->state = $location->regionName;
                $modifyTwostep->country = $location->countryName;
                $modifyTwostep->date = Carbon::now();
                $modifyTwostep->time = Carbon::now()->toTimeString();
                if($validated['twofactor']) {
                    $modifyTwostep->action = 'Включена';
                } else {
                    $modifyTwostep->action = 'Выключена';
                }
            }
            $modifyTwostep->save();
            $actionResent->modify_twostep_id = $modifyTwostep->id;
        }

        if(array_key_exists('reservedPassword', $validated)) {
            if(boolval($validated['reservedPassword']) !== boolval($setting->useReservedPassword)) {
                if (boolval($validated['reservedPassword'])) {
                    $reservedPassword = Str::random(4) . mt_rand(10, 99);
                    Mail::to($user->email)->send(new SendReservedPassword($reservedPassword, $user->name));

                    $backup->backup_password = Hash::make($reservedPassword);
                }
                $setting->useReservedPassword = $validated['reservedPassword'];

                if($actionResent->modify_reserved_password_id) {
                    $modifyTwostep = ModifyReservedPassword::find($actionResent->modify_reserved_password_id);
                    $modifyTwostep->city = $location->cityName;
                    $modifyTwostep->state = $location->regionName;
                    $modifyTwostep->country = $location->countryName;
                    $modifyTwostep->date = Carbon::now();
                    $modifyTwostep->time = Carbon::now()->toTimeString();
                    $modifyTwostep->action =  $validated['reservedPassword'] ? 'Включен' : 'Выключен';
                } else {
                    $modifyTwostep = new ModifyReservedPassword();
                    $modifyTwostep->city = $location->cityName;
                    $modifyTwostep->state = $location->regionName;
                    $modifyTwostep->country = $location->countryName;
                    $modifyTwostep->date = Carbon::now();
                    $modifyTwostep->time = Carbon::now()->toTimeString();
                    $modifyTwostep->action =  $validated['reservedPassword'] ? 'Включен' : 'Выключен';
                }
                $modifyTwostep->save();
                $actionResent->modify_reserved_password_id = $modifyTwostep->id;
            }
        }

        if(array_key_exists('useCode', $validated)) {
            $setting->useCodeWord = $validated['useCode'];
            if (array_key_exists('codeWord', $validated)) {
                if ($backup->code_word !== $validated['codeWord'] && strlen($backup->code_word) > 0) {
                    if ($actionResent->modify_codeword_id) {
                        $modifyTwostep = ModifyCodeword::find($actionResent->modify_codeword_id);
                        $modifyTwostep->city = $location->cityName;
                        $modifyTwostep->state = $location->regionName;
                        $modifyTwostep->country = $location->countryName;
                        $modifyTwostep->date = Carbon::now();
                        $modifyTwostep->time = Carbon::now()->toTimeString();
                        $modifyTwostep->action = 'Изменено';
                    } else {
                        $modifyTwostep = new ModifyCodeword();
                        $modifyTwostep->city = $location->cityName;
                        $modifyTwostep->state = $location->regionName;
                        $modifyTwostep->country = $location->countryName;
                        $modifyTwostep->date = Carbon::now();
                        $modifyTwostep->time = Carbon::now()->toTimeString();
                        $modifyTwostep->action = 'Изменено';
                    }
                } else {
                    if ($actionResent->modify_codeword_id) {
                        $modifyTwostep = ModifyCodeword::find($actionResent->modify_codeword_id);
                        $modifyTwostep->city = $location->cityName;
                        $modifyTwostep->state = $location->regionName;
                        $modifyTwostep->country = $location->countryName;
                        $modifyTwostep->date = Carbon::now();
                        $modifyTwostep->time = Carbon::now()->toTimeString();
                        $modifyTwostep->action = 'Создано';
                    } else {
                        $modifyTwostep = new ModifyCodeword();
                        $modifyTwostep->city = $location->cityName;
                        $modifyTwostep->state = $location->regionName;
                        $modifyTwostep->country = $location->countryName;
                        $modifyTwostep->date = Carbon::now();
                        $modifyTwostep->time = Carbon::now()->toTimeString();
                        $modifyTwostep->action = 'Создано';
                    }
                }
                $backup->code_word = $validated['codeWord'];
            }
            if(! $validated['useCode']){
                if($actionResent->modify_codeword_id) {
                    $modifyTwostep = ModifyCodeword::find($actionResent->modify_codeword_id);
                    $modifyTwostep->city = $location->cityName;
                    $modifyTwostep->state = $location->regionName;
                    $modifyTwostep->country = $location->countryName;
                    $modifyTwostep->date = Carbon::now();
                    $modifyTwostep->time = Carbon::now()->toTimeString();
                    $modifyTwostep->action =  'Удалено';
                } else {
                    $modifyTwostep = new ModifyCodeword();
                    $modifyTwostep->city = $location->cityName;
                    $modifyTwostep->state = $location->regionName;
                    $modifyTwostep->country = $location->countryName;
                    $modifyTwostep->date = Carbon::now();
                    $modifyTwostep->time = Carbon::now()->toTimeString();
                    $modifyTwostep->action = 'Удалено';
                }
            }
            $modifyTwostep->save();
            $actionResent->modify_codeword_id = $modifyTwostep->id;
        }

        if(array_key_exists('reservedEmail', $validated)) {

            if($backup->backup_email) {
                if(strlen($validated['reservedEmail']) > 0) {
                    if($actionResent->modify_reserved_email_id) {
                        $modifyTwostep = ModifyReservedEmail::find($actionResent->modify_reserved_email_id);
                        $modifyTwostep->city = $location->cityName;
                        $modifyTwostep->state = $location->regionName;
                        $modifyTwostep->country = $location->countryName;
                        $modifyTwostep->date = Carbon::now();
                        $modifyTwostep->time = Carbon::now()->toTimeString();
                        $modifyTwostep->action =  'Изменен';
                    } else {
                        $modifyTwostep = new ModifyReservedEmail();
                        $modifyTwostep->city = $location->cityName;
                        $modifyTwostep->state = $location->regionName;
                        $modifyTwostep->country = $location->countryName;
                        $modifyTwostep->date = Carbon::now();
                        $modifyTwostep->time = Carbon::now()->toTimeString();
                        $modifyTwostep->action = 'Изменен';
                    }
                } else {
                    if($actionResent->modify_reserved_email_id) {
                        $modifyTwostep = ModifyReservedEmail::find($actionResent->modify_reserved_email_id);
                        $modifyTwostep->city = $location->cityName;
                        $modifyTwostep->state = $location->regionName;
                        $modifyTwostep->country = $location->countryName;
                        $modifyTwostep->date = Carbon::now();
                        $modifyTwostep->time = Carbon::now()->toTimeString();
                        $modifyTwostep->action =  'Изменен';
                    } else {
                        $modifyTwostep = new ModifyReservedEmail();
                        $modifyTwostep->city = $location->cityName;
                        $modifyTwostep->state = $location->regionName;
                        $modifyTwostep->country = $location->countryName;
                        $modifyTwostep->date = Carbon::now();
                        $modifyTwostep->time = Carbon::now()->toTimeString();
                        $modifyTwostep->action = 'Удален';
                    }
                }
            } else {
                if($actionResent->modify_reserved_email_id) {
                    $modifyTwostep = ModifyReservedEmail::find($actionResent->modify_reserved_email_id);
                    $modifyTwostep->city = $location->cityName;
                    $modifyTwostep->state = $location->regionName;
                    $modifyTwostep->country = $location->countryName;
                    $modifyTwostep->date = Carbon::now();
                    $modifyTwostep->time = Carbon::now()->toTimeString();
                    $modifyTwostep->action =  'Создан';
                } else {
                    $modifyTwostep = new ModifyReservedEmail();
                    $modifyTwostep->city = $location->cityName;
                    $modifyTwostep->state = $location->regionName;
                    $modifyTwostep->country = $location->countryName;
                    $modifyTwostep->date = Carbon::now();
                    $modifyTwostep->time = Carbon::now()->toTimeString();
                    $modifyTwostep->action = 'Создан';
                }
            }

            $modifyTwostep->save();
            $actionResent->modify_reserved_email_id = $modifyTwostep->id;

            $backup->backup_email = $validated['reservedEmail'];
        }

        if(array_key_exists('suspiciousLoginNotifications', $validated)) {
            $setting->suspiciousLoginNotifications = $validated['suspiciousLoginNotifications'];

            if($actionResent->modify_notification_id) {
                $modifyTwostep = ModifyNotification::find($actionResent->modify_notification_id);
                $modifyTwostep->city = $location->cityName;
                $modifyTwostep->state = $location->regionName;
                $modifyTwostep->country = $location->countryName;
                $modifyTwostep->date = Carbon::now();
                $modifyTwostep->time = Carbon::now()->toTimeString();
                $modifyTwostep->action =  $validated['suspiciousLoginNotifications'] ? 'Включено' : 'Выключено';
            } else {
                $modifyTwostep = new ModifyNotification();
                $modifyTwostep->city = $location->cityName;
                $modifyTwostep->state = $location->regionName;
                $modifyTwostep->country = $location->countryName;
                $modifyTwostep->date = Carbon::now();
                $modifyTwostep->time = Carbon::now()->toTimeString();
                $modifyTwostep->action =  $validated['suspiciousLoginNotifications'] ? 'Включено' : 'Выключено';
            }
            $modifyTwostep->save();
            $actionResent->modify_notification_id = $modifyTwostep->id;
        }

        if(array_key_exists('password', $validated)) {
            $user->password = Hash::make($validated['password']);

            if($actionResent->modify_password_id) {
                $modifyTwostep = ModifyPassword::find($actionResent->modify_password_id);
                $modifyTwostep->city = $location->cityName;
                $modifyTwostep->state = $location->regionName;
                $modifyTwostep->country = $location->countryName;
                $modifyTwostep->date = Carbon::now();
                $modifyTwostep->time = Carbon::now()->toTimeString();
                $modifyTwostep->action = 'Изменен пароль';
            } else {
                $modifyTwostep = new ModifyPassword();
                $modifyTwostep->city = $location->cityName;
                $modifyTwostep->state = $location->regionName;
                $modifyTwostep->country = $location->countryName;
                $modifyTwostep->date = Carbon::now();
                $modifyTwostep->time = Carbon::now()->toTimeString();
                $modifyTwostep->action = 'Изменен пароль';
            }
            $modifyTwostep->save();
            $actionResent->modify_password_id = $modifyTwostep->id;
        }
        $user->setting()->save($setting);
        $user->backup_date()->save($backup);
        $user->action_recent()->save($actionResent);
        $user->refresh();

        return response()->json($user, 200);
    }
}

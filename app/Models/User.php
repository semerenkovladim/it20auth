<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
        'name',
        'surname',
        'middle_name',
        'avatar',
        'birth',
        'date_start',
        'email',
        'mobile_phone',
        'work_phone',
        'skype',
        'is_admin',
        'department_id',
        'password',
        'code',
        'ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'twostep_code',
        'code'
    ];

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function setting(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Setting::class);
    }

    public function access_level(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AccessLevel::class);
    }

    public function backup_date(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BackupData::class);
    }

    protected static function booted()
    {
        static::saved(function ($user) {
            $setting = new Setting();
            $setting->useTwoStepAuth = false;
            $setting->useReservedPassword = false;
            $setting->suspiciousLoginNotifications = false;
            $setting->useCodeWord = false;
            $setting->user_id = $user->id;

            $backup = new BackupData();
            $backup->backup_password = null;
            $backup->backup_email = null;
            $backup->code_word = null;

            $user->setting()->save($setting);
            $user->backup_date()->save($backup);

        });
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->getClientIp();
    }
}

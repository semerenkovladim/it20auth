<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionRecentModel extends Model
{
    use HasFactory;

    protected $table = "action_recent";

    public function modify_password(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModifyPassword::class, 'modify_password_id');
    }

    public function modify_twostep(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModifyTwostep::class, 'modify_twostep_id');
    }

    public function modify_reserved_password(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModifyReservedPassword::class, 'modify_reserved_password_id');
    }

    public function modify_reserved_email(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModifyReservedEmail::class, 'modify_reserved_email_id');
    }

    public function modify_notification(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModifyNotification::class, 'modify_notification_id');
    }

    public function modify_codeword(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModifyCodeword::class, 'modify_codeword_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

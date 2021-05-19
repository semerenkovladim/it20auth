<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'account',
        'disk',
        'mail',
        'calendar',
        'photo',
        'contacts',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

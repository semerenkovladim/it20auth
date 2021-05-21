<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifyNotification extends Model
{
    use HasFactory;
    protected $table = "modify_notification";

    protected $casts = [
        'date' => 'date:d-F-Y',
    ];
}

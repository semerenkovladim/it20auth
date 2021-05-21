<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifyPassword extends Model
{
    use HasFactory;

    protected $table = "modify_password";

    protected $casts = [
        'date' => 'date:d-F-Y',
    ];
}

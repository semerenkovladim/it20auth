<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifyReservedPassword extends Model
{
    use HasFactory;

    protected $table = "modify_reserved_password";

    protected $casts = [
        'date' => 'date:d-F-Y',
    ];
}

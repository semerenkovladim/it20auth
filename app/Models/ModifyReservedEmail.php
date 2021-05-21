<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifyReservedEmail extends Model
{
    use HasFactory;

    protected $table = "modify_reserved_email";

    protected $casts = [
        'date' => 'date:d-F-Y',
    ];
}

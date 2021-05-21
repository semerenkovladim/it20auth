<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifyCodeword extends Model
{
    use HasFactory;

    protected $table = "modify_codeword";

    protected $casts = [
        'date' => 'date:d-F-Y',
    ];
}

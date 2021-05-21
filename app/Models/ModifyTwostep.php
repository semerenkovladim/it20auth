<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifyTwostep extends Model
{
    use HasFactory;

    protected $table = "modify_twostep";

    protected $casts = [
        'date' => 'date:d-F-Y',
    ];
}

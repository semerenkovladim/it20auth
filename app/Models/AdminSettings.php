<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'email',
        'position',
        'department',
        'date_of_birth',
        'modules',
        'role',
        'user_id',
    ];
}

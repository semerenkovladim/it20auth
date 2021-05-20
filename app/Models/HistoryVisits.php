<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class HistoryVisits extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city',
        'state',
        'country',
        'date_history',
        'time_history',
        'type',
    ];

    protected $casts = [
        'date_history' => 'date:d-F-Y',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class Department extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'title',
        'head_department'
    ];



    public function header()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    //формирование списка отделов
    public function fetchAllDep()
    {
        $departments = Department::latest()->paginate(15);
        if ($departments) {
            $status = 201;
        } else {
            $status = 400;
        }
        return response()->json(['data' => $departments, 'status' => $status]);
    }

//========== добавление отдела ==================

    public function store($request)
    {
        $dep = new Department([
            'title' => $request->get('title'),
            'head_department' => $request->get('head_department')
        ]);

        $dep->save();
    }
}

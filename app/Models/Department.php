<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use App\Http\Controllers\API\DepartmentController;

class Department extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'head_department',
    ];

    protected $rules = [
        'title' => 'bail|required|string|min:3|max:150',
        'head_department' => 'bail|required|integer|min:1|max:150000',
    ];

    //========== Валидация при редактировании отдела ======

    public function validate($request)
    {
        $request->validate($this->rules);
    }

    //========== /Валидация при редактировании отдела ======

    //=========== формирование списка отделов ========

    public function fetchAllDep()
    {
        $departments = DB::table('departments')
            ->leftJoin('users', 'users.department_id', '=', 'departments.id')
            ->select('departments.id', 'name', 'surname', 'title', 'departments.created_at')
            ->latest()
            ->paginate(5);
        if ($departments) {
            $status = 201;
        } else {
            $status = 400;
        }
        return response()->json(['data' => $departments, 'status' => $status]);
    }

    //=========== /формирование списка отделов ========

    //======== формирование одного отдела =======

    public function showDepInfo($id)
    {
        $department = DB::table('departments')
            ->leftJoin('users', 'users.department_id', '=', 'departments.id')
            ->where('users.department_id', '=', "{$id}")
            ->get();

        return $department;
    }

    //======== /формирование одного отдела =======

    //========== добавление отдела ==================

    public function store($request)
    {
        $dep = new Department([
            'title' => $request->get('title'),
            'head_department' => $request->get('head_department')
        ]);

        $dep->save();
    }

    //========== добавление отдела ==================

    //========= удаление отдела =======

    public function deleteDepartment($department)
    {
        $dep = Department::find($department)->each->delete();
    }

    //========= /удаление отдела =======
}




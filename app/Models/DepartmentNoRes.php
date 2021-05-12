<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use App\Models\User;

class DepartmentNoRes extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

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

    //========== связи департаментов с пользователями

    public function header()
    {
        return $this->belongsTo(User::class, 'head_department', 'id');
    }


    //========== связи департаментов с пользователями

    public function getCountMembers($depID)
    {
        return $members = $this::find($depID)->loadCount('members');
    }

    public function getNameHeader($depID) {
        return $this::find($depID)->header()->where('name', 'surname');
    }

    public function getNameMembers($depID)
    {
        return $members = $this::find($depID);
    }


    public function test($id) {
//        $re = $this->getCountMembers($id)->get();
        $sh = Department::find($id);
//        $sh->head_department = $re;
        return (response()->json(['data' => $sh]));
    }

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

    public function deleteDepartment($request)
    {
        $dep = new Department;
        $dep->find($request);
        $dep->delete();
    }

    //========= /удаление отдела =======
}

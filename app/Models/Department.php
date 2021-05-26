<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use App\Http\Controllers\API\DepartmentController;
use Laravel\Scout\Searchable;
use phpDocumentor\Reflection\Types\Object_;

class Department extends Model
{
    use HasFactory, Searchable;


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

    public function members()
    {
        return $this->hasMany(User::class, 'department_id', 'id');

    }

    public function depHeader()

    {
        return $this->hasMany(User::class, 'id', 'head_department');
    }

    //=========== формирование списка отделов ========

    public function fetchAllDep($request)
    {
        if ($request->desc === "true") {
            $list = DB::table('departments')
                ->leftJoin('users', 'users.id', '=', 'departments.head_department')
                ->select('departments.id', 'departments.title', 'departments.created_at', 'users.name', 'users.surname')
                ->orderByDesc($request->orderBy)
                ->paginate(15);

        }   if($request->desc === "false") {

                $list = DB::table('departments')
                    ->leftJoin('users', 'users.id', '=', 'departments.head_department')
                    ->select('departments.id', 'departments.title', 'departments.created_at', 'users.name', 'users.surname')
                    ->orderBy($request->orderBy)
                    ->paginate(15);

        }

        foreach ($list as $item) {
            $id = $item->id;
            $item->count = DB::table('departments')
                ->select('departments.id', 'users.department_id', 'users.id as users_id')
                ->rightJoinWhere('users', 'users.department_id', '=', 'departments.id')
                ->where('users.department_id', '=', "${id}")
                ->count('users.id');
        }

        return $list;
    }

    public function sortListBy($key, $direct)
    {
//        return DB::table('departments')
//            ->leftJoin('users', 'users.id', '=', 'departments.head_department')
//            ->select('departments.id', 'departments.title', 'departments.created_at', 'users.name', 'users.surname')
//            ->orderBy("${key}", "${direct}")
//            ->paginate(15);
    }

    public function countMembers($id)
    {
        $list = DB::table('departments')
            ->select('departments.id', 'users.department_id', 'users.id as users_id')
            ->rightJoinWhere('users', 'users.department_id', '=', 'departments.id')
            ->where('users.department_id', '=', "${id}")
            ->count('users.id');

        return $list;
    }

    public function depIn()
    {
        return $this->fetchAllDep();
    }

    //=========== /формирование списка отделов ========

    public function getMembers()
    {
        return $this::all()->each->members;
    }

    public function getHeader($department)
    {
        return $department;

//        return $this::find($id)->each->depHeader;
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

    //========== /добавление отдела ==================

    //========= удаление отдела =======

    public function deleteDepartment($department)
    {
        $dep = Department::find($department)->each->delete();
    }

    //========= /удаление отдела =======

    //====== Редактирование отдела ====

    public function updateDep($data, $department)
    {

        $department->title = $data->get('title');
        $department->head_department = $data->get('head_department');

        $department->save();

    }

    //====== /Редактирование отдела ====

    //====== Поиск отдела ====

    public function search($request)
    {
        $result = Department::search($request->data)->paginate(5);
        $result->load('access_level','department');

        if (!$result) {
            return response()->json(['error' => 'По данному запросу записей не найдено', 'data' => $result, 'status' => false]);
        }
        return response()->json(['data' => $result, 'status' => true]);
    }

    //====== /Поиск отдела ====


}




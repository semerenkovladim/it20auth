<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function getAllDep()
    {
        $dep = Department::all();

        return response()->json($dep);
    }

    public function index(Request $request)
    {
        $dep = new Department;

        return $dep->fetchAllDep($request);
    }

    public function store(Request $request)
    {
        $dep = new Department;
        $dep->validate($request);
        $dep->store($request);

        return response()->json($dep);
    }

    public function search(Request $request)
    {
        $list = Department::search($request->data)->paginate(15);

        foreach ($list as $item) {
            $id = $item->id;

            $item->count = DB::table('departments')
                ->select('departments.id', 'users.department_id', 'users.id as users_id')
                ->rightJoinWhere('users', 'users.department_id', '=', 'departments.id')
                ->where('users.department_id', '=', "${id}")
                ->count('users.id');
        }

        return response()->json($list);
    }

    public function show(Department $department)
    {
        $dep = new Department;

        return $dep->getHeader($department);
    }

    public function update(Request $request, Department $department)
    {
        $dep = new Department;
        $dep->validate($request);
        $dep->updateDep($request, $department);

        return response()->json($dep);
    }

    public function destroy(Department $department)
    {
        $dep = new Department;
        $dep->deleteDepartment($department);

        return response()->json($dep);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getAllDep()
    {
        $dep = Department::all();
        return response()->json($dep);
    }

    public function index()
    {
        $dep = new Department;

        return $dep->fetchAllDep();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dep = new Department;
        $dep->validate($request);
        $dep->store($request);

        return response()->json($dep);
    }

    public function show(Department $department)
    {
        $dep = new Department;


        return $dep->getHeader($department);
    }

    public function edit(Department $department)
    {
        //
    }

    public function update(Request $request, Department $department)
    {
        $dep = new Department;
        $dep->validate($request);
        $dep->updateDep($request, $department);

        return response()->json($dep);
;
    }

    public function destroy(Department $department)
    {
        $dep = new Department;
        $dep->deleteDepartment($department);

        return $dep->fetchAllDep();
    }
}

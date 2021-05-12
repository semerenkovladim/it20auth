<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;

class DepartmentControllerNoRes extends Controller
{
    public function index()
    {
        $dep = new Department;

        return $dep->fetchAllDep();

    }

    public function store(Request $request)
    {
        $dep = new Department;
        $dep->validate($request);
        $dep->store($request);
        $dep->save();

        return response()->json($dep, 200);
    }

    public function destroy(Request $request) {
        $dep = new Department;
        $dep->deleteDepartment($request);
    }

    public function show($id) {
        $department = new Department;

        $department->getNameHeader($id);

        return (response()->json(['data' => $department]));

    }
}

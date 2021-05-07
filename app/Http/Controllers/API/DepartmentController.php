<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $dep = new Department;

        return $dep->fetchAllDep();
    }

    public function store(Request $request)
    {
        $dep = new Department;
        $dep->store($request);
        $dep->save();

        return response()->json($dep, 200);
    }


}

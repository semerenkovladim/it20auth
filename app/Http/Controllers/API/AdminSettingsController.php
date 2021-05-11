<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AdminSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminSettingsController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surname' => 'boolean',
            'name' => 'boolean',
            'patronymic' => 'boolean',
            'email' => 'boolean',
            'position' => 'boolean',
            'department' => 'boolean',
            'date_of_birth' => 'boolean',
            'modules' => 'boolean',
            'role' => 'boolean',
            'user_id' => 'boolean',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        }
        AdminSettings::make($request->all());

        return response()->json(['data' => $request, 'status' => true]);
    }

    public function show($id)
    {
        $settings = AdminSettings::find($id);
        if (!$settings) {
            return response()->json(['id' => $id, 'status' => false]);
        }
        return response()->json(['data' => $settings, 'status' => true]);
    }

    public function update(Request $request)
    {
        $settings = AdminSettings::find($request->id);
        if (!$settings) {
            return response()->json(['id' => $request->id, 'status' => false]);
        }
        $validator = Validator::make($request->all(), [
            'surname' => 'boolean',
            'name' => 'boolean',
            'patronymic' => 'boolean',
            'email' => 'boolean',
            'position' => 'boolean',
            'department' => 'boolean',
            'date_of_birth' => 'boolean',
            'modules' => 'boolean',
            'role' => 'boolean',
            'user_id' => 'boolean',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        }

        $settings->update($request->all());

        return response()->json(['data' => $settings, 'status' => true]);
    }
}

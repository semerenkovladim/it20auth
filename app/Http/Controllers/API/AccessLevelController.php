<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AccessLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccessLevelController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        }
        $access = AccessLevel::make();
        $access->user_id = $request->user_id;
        $access->save();

        return response()->json(['data' => $access, 'status' => true]);
    }

    public function show($id)
    {
        $accessLevel = AccessLevel::where('user_id', '=', $id);
        if (!$accessLevel) {
            return response()->json(['error' => 'not found', 'status' => false]);
        }
        return response()->json(['data' => $accessLevel, 'status' => true]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}

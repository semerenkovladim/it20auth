<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AccessLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccessLevelController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $access = AccessLevel::all();
        if (!$access) {
            return response()->json(['data' => $access, 'status' => false]);
        }
        return response()->json(['data' => $access, 'status' => true]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        }
        $access = AccessLevel::make();
        $access->account = true;
        $access->user_id = $request->user_id;
        $access->save();

        return response()->json(['data' => $access, 'status' => true]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
//

        $access = AccessLevel::where('user_id', '=', $id)->get();
        if (!count($access)) {
            return response()->json(['error' => 'Ошибка', 'status' => false]);
        }
        $accessLevel = $access[0];
        return response()->json(['data' => $accessLevel, 'id' => $id, 'status' => true]);
    }


    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $accesses = AccessLevel::where('user_id', '=', $request->user_id)->get();
        if (!count($accesses)) {
            return response()->json(['error' => 'not found', 'status' => false]);
        }
        $access = $accesses[0];
        if (!$access) {
            return response()->json(['error' => 'not found', 'status' => false]);

        }
        $accessLevel = AccessLevel::find($access->id);
        if (!$accessLevel) {
            return response()->json(['error' => 'not found', 'status' => false]);

        }
        $validator = Validator::make($request->all(), [
            'disk' => 'boolean',
            'mail' => 'boolean',
            'calendar' => 'boolean',
            'photo' => 'boolean',
            'contacts' => 'boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);

        }
        $data = $request->data;
        $accessLevel->fill($data)->save();
        return response()->json(['data' => $accessLevel, 'status' => true]);

    }

    /*  public function destroy($id)
      {
          $accessLevel = AccessLevel::where('user_id', '=', $id);
          if(!$accessLevel) {
              return response()->json(['error' => 'not found', 'status' => false]);
          }
          $accessLevel->delete();

          return response()->json(['data' => $accessLevel, 'status' => true]);
      }*/
}

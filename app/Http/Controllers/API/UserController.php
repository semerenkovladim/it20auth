<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(6);
        if ($users) {
            $status = 200;
        } else {
            $status = 404;
        }
        return response()->json(['data' => $users, 'status' => $status]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'image|nullable|size:2048|mimes:jpg,bmp,png,jpeg,webp',
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'birth' => 'date|required',
            'department_id' => 'int|nullable',
            'position' => 'required|max:225',
            'date_start' => 'date|nullable',
            'is_admin' => 'boolean',
            'email' => 'email|required|max:255|unique:users',
            'mobile_phone' => 'max:12|int|nullable',
            'work_phone' => 'max:12|int|nullable',
            'skype' => 'max:255|nullable',
            'password' => 'min:6|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 402);
        }
        $user = User::make($request->all());
        $user->password = Str::random(8);

        $user->save();

        return response()->json(['data' => $user, 'password' => $user->password, 'status' => 200]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            $status = 404;
        } else {
            $status = 200;
        }
        return response()->json(['data' => $user, 'status' => $status]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'avatar' => 'image|nullable|size:2048|mimes:jpg,bmp,png,jpeg,webp',
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'birth' => 'date|required',
            'department_id' => 'int|nullable',
            'position' => 'required|max:225',
            'date_start' => 'date|nullable',
            'is_admin' => 'boolean',
            'email' => 'email|required|max:255|unique:users',
            'mobile_phone' => 'max:12|int|nullable',
            'work_phone' => 'max:12|int|nullable',
            'skype' => 'max:255|nullable',
            'password' => 'min:6|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 402);
        }

        $user->update($request->all());

        return response()->json(['data' => $user, 'status' => 200]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $status = true;
            $message = 'Товар удален!';
        } else {
            $status = false;
            $message = 'Товар не найден!';
        }

        return response()->json(['data' => $user, 'message' => $message, 'status' => $status]);
    }
}

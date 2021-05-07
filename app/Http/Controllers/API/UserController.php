<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(6);
        if ($users) {
            $status = true;
        } else {
            $status = false;
        }
        return response()->json(['data' => $users, 'status' => $status]);
    }

    public function in_department($id)
    {
        $users = User::where('department_id', '=', $id)->paginate(6);
        if ($users) {
            $status = true;
        } else {
            $status = false;
        }
        return response()->json(['data' => $users, 'status' => $status]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'birth' => 'date|required|before:today',
            'department_id' => 'int|nullable',
            'position' => 'required|max:225',
            'date_start' => 'date|nullable',
            'is_admin' => 'boolean|nullable',
            'email' => 'email|required|max:255|unique:users',
            'mobile_phone' => 'numeric|digits_between:8,12|nullable',
            'work_phone' => 'numeric|digits_between:8,12|nullable',
            'skype' => 'max:255|nullable|unique:users'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        }
        $user = User::make($request->all());
        $password = Str::random(8);
        $user->password = Hash::make($password);

        $user->save();

        return response()->json(['data' => $user, 'password' => $password, 'status' => true]);


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

    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $data = $request->all();


        if ($user->email === $data['email']) {
            unset($data['email']);
        }
        if ($user->skype === $data['skype']) {
            unset($data['skype']);
        }
        $validator = Validator::make($data, [
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'birth' => 'date|required',
            'department_id' => 'int|nullable',
            'position' => 'required|max:225',
            'date_start' => 'date|nullable',
            'is_admin' => 'boolean|nullable',
            'email' => 'email|unique:users|max:255',
            'mobile_phone' => 'numeric|digits_between:8,12|nullable',
            'work_phone' => 'numeric|digits_between:8,12|nullable',
            'skype' => 'max:255|nullable|unique:users'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        }
        $user->fill($data)->save();

        return response()->json(['data' => $data, 'status' => true]);

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

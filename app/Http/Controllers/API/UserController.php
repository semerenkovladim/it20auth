<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendUserPassword;
use App\Models\AccessLevel;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('department')->paginate(6);
        if ($users) {
            $status = true;
        } else {
            $status = false;
        }
        return response()->json(['data' => $users, 'status' => $status]);
    }

    public function in_department($id)
    {
        $users = User::with('department')->where('department_id', '=', $id)->paginate(6);
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
            'email' => 'email|required|unique:users|max:255',
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
        $email = $user->email;

        $data = ([
            'name' => $request->get('name'),
            'password' => $password,
            'email' => $request->get('email'),
            'app_name' => env('APP_NAME'),
            'app_location' => env('APP_URL')
        ]);

        Mail::to($email)->send(new SendUserPassword($data));

        $user->save();

        return response()->json(['data' => $user, 'status' => true]);


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

    public function resetDepartment(Request $request, $id)
    {
        $user = User::find($id);
        $user -> department_id = null;
        $user->save();

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

    public function destroy(Request $request)
    {
        $data = $request->data;
        foreach ($data as $id) {
            $user = User::find($id);
            if ($user) {
                $accessLevel = AccessLevel::where('user_id', '=', $id);
                $user->delete();
                if ($accessLevel) {
                    $accessLevel->delete();
                }
                $status = true;
                $message = 'Удалено';
            } else {
                $status = false;
                $message = 'Ошибка';
            }

        }
        return response()->json(['data' => $data, 'message' => $message, 'status' => $status]);
    }
}

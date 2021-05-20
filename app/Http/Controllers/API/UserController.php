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
    public function index(Request $request)
    {
        if ($request->desc === 'true'){
            $users = User::with('department', 'access_level')->orderByDesc($request->orderBy)->paginate(15);
        } else {
            $users = User::with('department', 'access_level')->orderBy($request->orderBy)->paginate(15);
        }
        if ($users) {
            $status = true;
        } else {
            $status = false;
        }
        return response()->json(['data' => $users, 'request'=>$request->all(),'status' => $status]);
    }

    public function in_department(Request $request, $id)
    {
        if ($request->desc === 'true'){
            $users = User::with('department','access_level')->where('department_id', '=', $id)->orderByDesc($request->orderBy)->paginate(15);
        } else {
            $users = User::with('department','access_level')->where('department_id', '=', $id)->orderBy($request->orderBy)->paginate(15);
        }
        if ($users) {
            $status = true;
        } else {
            $status = false;
        }
        return response()->json(['data' => $users, 'status' => $status]);
    }

    public function store(Request $request)
    {
        $requiredValidator = Validator::make($request->all(), [
            'surname' => 'required',
            'name' => 'required',
            'position' => 'required',
            'birth' => 'required',
            'email' => 'required',
        ]);
        if ($requiredValidator->fails()) {
            return response()->json(['error' => 'Заполните, пожалуйста, все обязательные поля', 'status' => false]);
        }
        $uniqueValidator = Validator::make($request->all(), [
            'email' => 'email|unique:users',
            'skype' => 'nullable|unique:users'
        ]);
        if ($uniqueValidator->fails()) {
            return response()->json(['error' => 'Данные некорректны или уже используются', 'status' => false]);
        }
        $validator = Validator::make($request->all(), [
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'birth' => 'date|required|before:tomorrow',
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
            return response()->json(['errors' => $validator->errors(), 'error' => 'Проверьте правильность заполнения обязательных полей']);
        }
        $userData = $request->all();
        unset($userData->access_level);
        $user = User::make($userData);

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

        $user_id = $user->id;

        $access = AccessLevel::make([
            'account' => $request->access_level['account'],
            'disk' => $request->access_level['disk'],
            'mail' => $request->access_level['mail'],
            'calendar' => $request->access_level['calendar'],
            'photo' => $request->access_level['photo'],
            'contacts' => $request->access_level['contacts'],
            'user_id' => $user_id,
        ]);
        $access->save();

        return response()->json(['data' => $user, 'status' => true]);


    }

    public function show($id)
    {
        $user = User::with('access_level')->find($id);
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
        $user->department_id = null;
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
        if (!$user->name || !$user->birth || !$user->surname || !$user->position || !$user->email) {
            return response()->json(['error' => 'Заполните, пожалуйста, все обязательные поля', 'data' => $data, 'status' => false]);
        }

        $validator = Validator::make($data, [
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'birth' => "date|required|before:tomorrow",
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
            return response()->json(['error' => 'Проверьте правильность заполнения обязательных полей', 'data' => $data, 'status' => false]);
        }
        $access = AccessLevel::find($request->access_level['id']);
        $accessData = $request->access_level;
        $access->fill($accessData)->save();
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
            }
        }
        return response()->json(['data' => $data, 'message' => 'Удалено', 'status' => true]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Response;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        $user = User::where(Auth::user()->id)->get();
        return response()->json([
            'user'    => $user,
        ], 200);
    }

    public function profile()
    {
        return auth('api')->user();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::find($user);
        return response()->json(['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

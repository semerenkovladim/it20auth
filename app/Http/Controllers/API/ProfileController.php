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

    public function index($id)
    {

    }




    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->surname = $request->get('surname');
        $user->name = $request->get('name');
        $user->middle_name = $request->get('middle_name');
        $user->birth = $request->get('birth');
        $user->departament_id = $request->get('departament_id');
        $user->position = $request->get('position');
        $user->date_start = $request->get('date_start');
        $user->email = $request->get('email');
        $user->mobile_phone = $request->get('mobile_phone');
        $user->work_phone = $request->get('work_phone');
        $user->skype = $request->get('skype');

        $user->save();
        return response(null, \Illuminate\Http\Response::HTTP_OK);
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

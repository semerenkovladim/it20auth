<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ActionRecentModel;
use Illuminate\Http\Request;

class ActionResentController extends Controller
{
    public function index(Request $request)
    {
        $actionResent = ActionRecentModel::where('user_id', $request->user()->id)
            ->with(['modify_password', 'modify_twostep', 'modify_reserved_password', 'modify_reserved_email', 'modify_notification', 'modify_codeword'])
            ->first();

        return response()->json($actionResent, 200);
    }
}

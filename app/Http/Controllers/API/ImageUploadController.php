<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function upload_avatar(Request $request)
    {
        if (!$request) {
            return response()->json('Ошибка');
        }

        $validator = Validator::make($request->all(), [
            'avatar' => 'image|nullable|size:2048|mimes:jpg,bmp,png,jpeg,webp'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 402);
        }
        $path = $request->file('file')->store('img/avatars', 'public');
        return response()->json(['path' => '/storage/' . $path]);
    }
}

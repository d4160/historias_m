<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index(Request $request)
    {
        $user = User::where('num_document', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $user->tokens()->delete();

        $token = $user->createToken('yabaja-token')->plainTextToken;

        $response = [
            //'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}

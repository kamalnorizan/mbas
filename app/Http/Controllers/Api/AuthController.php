<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}

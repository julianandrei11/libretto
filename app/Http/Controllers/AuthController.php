<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        // Check for existing token
        $token = $user->tokens()->latest()->first();

        if ($token && Carbon::parse($token->created_at)->addDay()->isFuture()) {
            return response()->json([
                'token' => $token->token,
                'message' => 'Existing token still valid'
            ]);
        }

        // Delete old tokens and generate new one
        $user->tokens()->delete();

        $newToken = $user->createToken('libretto_token');

        return response()->json([
            'token' => $newToken->plainTextToken,
            'message' => 'New token generated'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

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
    
        // Optional: reuse existing token if not expired (up to you)
        $existingToken = $user->tokens()->latest()->first();
    
        if ($existingToken && Carbon::parse($existingToken->created_at)->addDay()->isFuture()) {
            return response()->json([
                'token' => $existingToken->token,
                'message' => 'Login successful. Existing token still valid.',
                'user' => $user
            ]);
        }
    
        // Delete old tokens
        $user->tokens()->delete();
    
        return response()->json([
            'token' => $newToken,
            'message' => 'Login successful. New token generated.',
            'user' => $user
        ]);
    }
    

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

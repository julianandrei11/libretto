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

        // Attempt login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        // Check for existing token
        $existingToken = $user->tokens()->latest()->first();

        if ($existingToken && Carbon::parse($existingToken->created_at)->addDay()->isFuture()) {
            return response()->json([
                'message' => 'Login successful. Existing token still valid.',
                'token' => $existingToken->plainTextToken ?? null, // only available at creation time
                'user' => $user
            ]);
        }

        // Delete old tokens
        $user->tokens()->delete();

        // Create new token with 1-day expiration
        $newToken = $user->createToken('libretto_token');
        $plainTextToken = $newToken->plainTextToken;
        $newToken->accessToken->expires_at = now()->addDay();
        $newToken->accessToken->save();

        return response()->json([
            'message' => 'Login successful. New token generated.',
            'token' => $plainTextToken,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

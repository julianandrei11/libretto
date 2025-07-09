<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form (for web users).
     */
    public function showRegistrationForm()
    {
        return view('login.register.register'); // adjust path if needed
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);

        // If validation fails
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Delete existing tokens for user
        $user->tokens()->delete();

        // Set expiration time (e.g., 1 day from now)
        $expiration = now()->addDay();

        // Create new token and save expiration
        $token = $user->createToken('libretto_token');
        $plainTextToken = $token->plainTextToken;
        $token->accessToken->expires_at = $expiration;
        $token->accessToken->save();

        // Return JSON response
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'User registered successfully',
                'token' => $plainTextToken,
                'token_type' => 'Bearer',
                'expires_at' => $expiration->toDateTimeString(),
                'user' => $user,
            ], 201);
        }

        // Otherwise, redirect to login page
        return redirect('/login')->with('success', 'Registration successful! You may now log in.');
    }
}

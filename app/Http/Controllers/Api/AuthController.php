<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Register a new user and return API token
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create token with 1-day expiry
        $token = $user->createToken('libretto-token', ['*'], Carbon::now()->addDay());

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token->plainTextToken,
            'token_expires_at' => $token->accessToken->expires_at,
        ], 201);
    }

    /**
     * Login user and return API token (regenerate if expired)
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        // Check if user has existing tokens
        $existingTokens = $user->tokens()->where('name', 'libretto-token')->get();

        foreach ($existingTokens as $token) {
            // Check if token is expired
            if ($token->expires_at && Carbon::now()->greaterThan($token->expires_at)) {
                // Delete expired token
                $token->delete();
            } else {
                // Token is still valid, return existing token info
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful - using existing token',
                    'user' => $user,
                    'token' => $token->token,
                    'token_expires_at' => $token->expires_at,
                    'note' => 'Existing valid token found'
                ]);
            }
        }

        // No valid token found, create new one with 1-day expiry
        $token = $user->createToken('libretto-token', ['*'], Carbon::now()->addDay());

        return response()->json([
            'success' => true,
            'message' => 'Login successful - new token generated',
            'user' => $user,
            'token' => $token->plainTextToken,
            'token_expires_at' => $token->accessToken->expires_at,
        ]);
    }

    /**
     * Get current user info
     */
    public function user(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $request->user(),
            'token_info' => [
                'expires_at' => $request->user()->currentAccessToken()->expires_at,
                'name' => $request->user()->currentAccessToken()->name,
            ]
        ]);
    }

    /**
     * Logout user and revoke token
     */
    public function logout(Request $request)
    {
        // Revoke current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Logout from all devices (revoke all tokens)
     */
    public function logoutAll(Request $request)
    {
        // Revoke all tokens
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out from all devices successfully'
        ]);
    }

    /**
     * Check token status
     */
    public function tokenStatus(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $isExpired = $token->expires_at && Carbon::now()->greaterThan($token->expires_at);

        return response()->json([
            'success' => true,
            'token_name' => $token->name,
            'expires_at' => $token->expires_at,
            'is_expired' => $isExpired,
            'time_until_expiry' => $token->expires_at ? Carbon::now()->diffForHumans($token->expires_at, true) : null,
        ]);
    }
} 
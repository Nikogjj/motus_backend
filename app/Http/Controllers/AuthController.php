<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\wall_of_fame;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'pseudo' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'pseudo' => $request->pseudo,
            'password' => Hash::make($request->password),
            'numero_secu' => $request->numerosecu
        ]);

        $wall_of_fame =  new wall_of_fame();
        $wall_of_fame->score = 0;
        $wall_of_fame->user_id = $user->id;
        $wall_of_fame->save();

        // try {
        //     $token = JWTAuth::fromUser($user);
        // } catch (JWTException $e) {
        //     return response()->json(['error' => 'Could not create token'], 500);
        // }

        return response()->json([
            "message" => "Compte créé avec succès !",
            "error" => "none"
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('pseudo', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json([
            'token' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getUser()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to fetch user profile'], 500);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $user = Auth::user();
            $user->update($request->only(['name', 'email']));
            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to update user'], 500);
        }
    }
}

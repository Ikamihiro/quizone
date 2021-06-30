<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->validated());

            // TODO: Criar o Profile com pontuação zerada

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return response()->json([
            'user' => $user,
            'access_token' => $user->createToken($request->name)->plainTextToken,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->delete();

        return response()->json([
            'user' => $user,
            'access_token' => $user->createToken($user->email)->plainTextToken,
        ]);
    }

    public function getCurrentUser()
    {
        return response()->json(auth()->user());
    }
}

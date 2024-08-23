<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegistrationRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request, AuthService $authService): JsonResponse
    {
        try{
            $user = $authService->registerNewUser($request->validated());
            return response()->json([
                'message' => 'User successfully registered.',
                'user' => $user,
            ], 201);
        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], $exception->status);
        }
    }

    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        try{
            $token = $authService->loginUser($request->validated());
            return response()->json([
                'message' => 'User successfully logged in.',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 422);
        }
    }
}

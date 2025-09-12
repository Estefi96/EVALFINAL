<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\JsonResponse;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales inválidas'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'message' => 'Ingreso exitoso',
            'token'   => $token,
        ]);
    }
}

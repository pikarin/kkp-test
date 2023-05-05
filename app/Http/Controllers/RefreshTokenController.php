<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class RefreshTokenController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $token = auth()->refresh();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

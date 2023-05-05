<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyEmailRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class VerifyEmailController extends Controller
{
    public function __invoke(VerifyEmailRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->firstOrFail();

        if ($user->otp != $request->otp) {
            return response()->json([
                'message' => 'OTP is not match',
            ], 422);
        }

        $user->markEmailAsVerified();

        return response()->json([
            'message' => 'Email verified, please wait for Admin to activate your account',
        ]);
    }
}

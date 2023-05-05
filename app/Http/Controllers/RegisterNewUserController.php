<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterNewUserRequest;
use App\Jobs\SendOtpEmailJob;
use App\Models\User;

class RegisterNewUserController extends Controller
{
    public function __invoke(RegisterNewUserRequest $request)
    {
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'otp' => $otp,
        ]);

        $user->assignRole('User');

        $this->dispatch(new SendOtpEmailJob($user));

        return response()->json([
            'message' => 'Account created, please check your email for the OTP code',
        ], 201);
    }
}

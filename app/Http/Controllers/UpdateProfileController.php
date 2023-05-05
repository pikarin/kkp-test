<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;

class UpdateProfileController extends Controller
{
    public function __invoke(UpdateProfileRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $user->update($request->validated());

        return response()->json([
            'message' => 'Successfully update profile',
        ]);
    }
}

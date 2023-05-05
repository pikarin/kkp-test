<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class ActivateUserController extends Controller
{
    public function __invoke(int $id): JsonResponse
    {
        $this->authorize('user_activate');

        $user = User::findOrFail($id);

        $user->is_active = true;
        $user->save();

        return response()->json([
            'message' => 'User successfuly activated',
        ]);
    }
}

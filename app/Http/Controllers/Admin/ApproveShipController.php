<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ship;

class ApproveShipController extends Controller
{
    public function __invoke(int $id)
    {
        $this->authorize('ship_verify');

        $ship = Ship::pending()->findOrFail($id);

        $ship->markAsVerified(auth()->id());

        return response()->json([
            'message' => 'Successfully approve ship',
        ]);
    }
}

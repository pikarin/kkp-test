<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RejectShipRequest;
use App\Models\Ship;
use Illuminate\Http\Request;

class RejectShipController extends Controller
{
    public function __invoke(RejectShipRequest $request, int $id)
    {
        $this->authorize('ship_verify');

        $ship = Ship::pending()->findOrFail($id);

        $ship->markAsRejected(
            userId: auth()->id(),
            remarks: $request->remarks,
        );

        return response()->json([
            'message' => 'Ship has been rejected',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\RegisterShipAction;
use App\Actions\UpdateShipAction;
use App\DTO\NewShip;
use App\DTO\ShipData;
use App\Http\Requests\StoreShipRequest;
use App\Http\Requests\UpdateShipRequest;
use App\Models\Ship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShipController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $ships = Ship::active()->latest()->paginate($request->perPage ?? 10);

        return response()->json($ships->through(fn ($ship) => $ship->makeHidden([
            'permit_document_path',
            'remarks',
            'deleted_at',
        ])));
    }

    public function store(StoreShipRequest $request, RegisterShipAction $registerShip): JsonResponse
    {
        $this->authorize('ship_register');

        $shipData = NewShip::fromArray([...$request->validated(), 'user_id' => auth()->id()]);

        $ship = $registerShip->execute($shipData);

        return response()->json([
            'message' => 'Ship registered successfully',
            'data' => $ship,
        ], 201);
    }


    public function show($id)
    {
        //
    }

    public function update(UpdateShipRequest $request, UpdateShipAction $updateShip, int $id): JsonResponse
    {
        $this->authorize('ship_edit');

        $ship = Ship::notActive()->findOrFail($id);

        abort_if($ship->user_id != auth()->id(), 401);

        $shipData = ShipData::fromArray([
            ...$request->validated(),
            'id' => $ship->id,
            'status' => $ship->status,
        ]);

        $updateShip->execute($shipData);

        return response()->json([
            'message' => 'Ship successfully updated',
        ]);
    }
}

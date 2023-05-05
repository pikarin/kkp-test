<?php

namespace App\Http\Controllers;

use App\Actions\RegisterShipAction;
use App\DTO\NewShip;
use App\Http\Requests\StoreShipRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShipController extends Controller
{

    public function index()
    {
        //
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

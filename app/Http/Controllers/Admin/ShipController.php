<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $this->authorize('ship_access');

        $ships = Ship::query();

        if ($request->status) {
            $ships->where('status', $request->status);
        }

        return response()->json($ships->paginate($request->perPage ?? 10));
    }

    public function show(int $id): JsonResponse
    {
        $this->authorize('ship_access');

        $ship = Ship::with(['user', 'verifier'])->findOrFail($id);

        return response()->json($ship);
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

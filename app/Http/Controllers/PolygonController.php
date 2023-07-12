<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePolygonRequest;
use App\Http\Resources\PolygonResource;
use App\Models\Zone;
use App\Services\PolygonService;
use Illuminate\Http\Request;
use App\Models\Polygon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Contracts\View\View;


class PolygonController extends Controller
{


    public function __construct(PolygonService $polygonService)
    {
        $this->polygonService = $polygonService;
    }

    public function showMap(): View
    {
        $zones = Zone::all();

        return view('pages.maps', ['zones' => $zones]);
    }

    public function loadPolygons(): AnonymousResourceCollection
    {
        $polygons = Polygon::all();

        return PolygonResource::collection($polygons);
    }

    public function deletePolygon(Request $request): JsonResponse
    {
        $name = $request->input('name');

        Polygon::deletePolygonByName($name);

        return response()->json(['message' => 'Polygon deleted successfully']);
    }


    public function isPointInPolygon(Request $request): JsonResponse
    {
        $point = ['x' => $request->input('x'), 'y' => $request->input('y')];

        if ($this->polygonService->isPointInPolygon($point)) {
            return response()->json(['result' => true]);
        }
        return response()->json(['result' => false]);
    }

    public function storePolygon(StorePolygonRequest $request): JsonResponse
    {
        $name = $request->input('name');
        $zoneId = $request->input('zone');
        $polygonCoordinates = $request->input('polygonCoordinates');
        $zone = Zone::findOrFail($zoneId);
        $this->polygonService->createPolygon($name, $polygonCoordinates, $zone);

        return response()->json(['message' => 'Polygon saved successfully']);
    }
}

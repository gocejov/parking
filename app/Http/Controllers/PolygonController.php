<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePolygonRequest;
use App\Http\Resources\PolygonResource;
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
        return view('pages.maps');
    }

    public function loadPolygons(): AnonymousResourceCollection
    {
        $polygons = Polygon::all();

        return PolygonResource::collection($polygons);
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
        $polygonCoordinates = $request->input('polygonCoordinates');
        $this->polygonService->createPolygon($name, $polygonCoordinates);

        return response()->json(['message' => 'Polygon saved successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePolygonRequest;
use App\Http\Resources\PolygonResource;
use App\Models\UserSettings;
use App\Models\Zone;
use App\Services\PolygonService;
use Illuminate\Http\Request;
use App\Models\Polygon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
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


    public function checkPointsAndGetUserWithZone(Request $request): JsonResponse
    {
        $point = ['x' => $request->input('x'), 'y' => $request->input('y')];

        if ($polygon = $this->polygonService->isPointInPolygon($point)) {
            $loggedUser = Auth::user();
            $userData = UserSettings::where('user_id', $loggedUser->id)
                ->with('user', 'zone', 'zone.tariffs')
                ->first();

            $newZoneId = $polygon->zone_id;
            $userData->updateCurrentUserZone($newZoneId);

            return response()->json([
                'result' => true,
                'userData' => $userData,
            ]);
        } else {
            return response()->json(['result' => false]);
        }
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

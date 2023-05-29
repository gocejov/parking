<?php

namespace App\Http\Controllers;

use App\Http\Resources\PolygonResource;
use Illuminate\Http\Request;
use App\Models\Polygon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Contracts\View\View;


class PolygonController extends Controller
{

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
        $polygons = Polygon::all();

        foreach ($polygons as $polygon) {
            if ($this->checkPointInPolygon($point, $polygon->vertices)) {
                return response()->json(['result' => true]);
            }
        }

        return response()->json(['result' => false]);
    }

    public function storePolygon(Request $request): JsonResponse
    {
        $request->validate([
            'polygonCoordinates' => 'required|array',
            'polygonCoordinates.*' => 'required|array',
            'polygonCoordinates.*.*' => 'required|numeric',
            'name' => 'required|string'
        ]);

        $name = $request->input('name');
        $polygonCoordinates = $request->input('polygonCoordinates');

        $polygon = new Polygon();
        $polygon->name = $name;
        $polygon->vertices = json_encode($polygonCoordinates);
        $polygon->save();

        return response()->json(['message' => 'Polygon saved successfully']);
    }

    private function checkPointInPolygon(array $point, $polygon): bool
    {
        $polygon = json_decode($polygon, true);

        $polySides = count($polygon);
        $j = $polySides - 1;
        $oddNodes = false;
        for ($i = 0; $i < $polySides; $i++) {
            if (($polygon[$i][1] < $point['y'] && $polygon[$j][1] >= $point['y'] ||
                    $polygon[$j][1] < $point['y'] && $polygon[$i][1] >= $point['y']) &&
                ($polygon[$i][0] <= $point['x'] || $polygon[$j][0] <= $point['x'])) {
                if ($polygon[$i][0] + ($point['y'] - $polygon[$i][1]) /
                    ($polygon[$j][1] - $polygon[$i][1]) * ($polygon[$j][0] - $polygon[$i][0]) < $point['x']) {
                    $oddNodes = !$oddNodes;
                }
            }
            $j = $i;
        }
        return $oddNodes;
    }
}

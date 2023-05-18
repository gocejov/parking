<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polygon;
use Symfony\Component\HttpFoundation\JsonResponse;


class PolygonController extends Controller
{


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
        // Validate the polygon coordinates
        $request->validate([
            'polygonCoordinates' => 'required|array',
            'polygonCoordinates.*' => 'required|array',
            'polygonCoordinates.*.*' => 'required|numeric',
        ]);

        // Extract the polygon coordinates from the request
        $polygonCoordinates = $request->input('polygonCoordinates');

        // Save the polygon data
        $polygon = new Polygon();
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

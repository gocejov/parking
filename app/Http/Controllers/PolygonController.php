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

    private function checkPointInPolygon(array $point, array $polygon): bool
    {
        $polySides = count($polygon);
        $j = $polySides - 1;
        $oddNodes = false;

        for ($i = 0; $i < $polySides; $i++) {
            if (($polygon[$i]['y'] < $point['y'] && $polygon[$j]['y'] >= $point['y'] ||
                    $polygon[$j]['y'] < $point['y'] && $polygon[$i]['y'] >= $point['y']) &&
                ($polygon[$i]['x'] <= $point['x'] || $polygon[$j]['x'] <= $point['x'])) {
                if ($polygon[$i]['x'] + ($point['y'] - $polygon[$i]['y']) /
                    ($polygon[$j]['y'] - $polygon[$i]['y']) * ($polygon[$j]['x'] - $polygon[$i]['x']) < $point['x']) {
                    $oddNodes = !$oddNodes;
                }
            }
            $j = $i;
        }
        return $oddNodes;
    }


}

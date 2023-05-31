<?php

namespace App\Services;

use App\Models\Polygon;

class PolygonService
{
    public function createPolygon(string $name, array $polygonCoordinates): Polygon
    {
        return Polygon::create([
            'name' => $name,
            'vertices' => json_encode($polygonCoordinates)
        ]);
    }

    public function checkPointInPolygon(array $point, $polygon): bool
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

    public function isPointInPolygon(array $point): bool
    {
        $polygons = Polygon::all();
        foreach ($polygons as $polygon) {
            if ($this->checkPointInPolygon($point, $polygon->vertices)) {
                return true;
            }
        }
        return false;
    }
}

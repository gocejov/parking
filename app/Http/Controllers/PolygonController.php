<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;


class PolygonController extends Controller
{

    public function checkPoints(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $result = $lat && $lng;

        return response()->json($result);
    }

}

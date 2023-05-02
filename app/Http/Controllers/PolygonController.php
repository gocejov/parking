<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;


class PolygonController extends Controller
{

    public function someFunction(Request $request)
    {

        $user = Auth::user();

        $lat = $request->input('lat');
        $lng = $request->input('lng');



        // Return a response
        return response()->json([
            'message' => 'Received latitude and longitude data',
            'lat' => $lat,
            'lng' => $lng,
            'user' => $user
        ]);
    }

}

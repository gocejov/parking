<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserVehicleRequest;
use App\Models\UserVehicle;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class UserVehicleController extends Controller
{
    public function saveVehicle(AddUserVehicleRequest $request): JsonResponse
    {
        $user = auth()->user();
        $vehicleId = $request->input('vehicle_id'); // If available for update
        $vehicleData = [
            'license_plate' => $request->input('license_plate'),
            'default_park_time' => $request->input('default_park_time'),
            'phone_number' => $request->input('phone_number'),
            'vehicle_make' => $request->input('vehicle_make'),
            'vehicle_model' => $request->input('vehicle_model'),
        ];

        if ($vehicleId) {
            $vehicle = $user->vehicles->find($vehicleId);
            if ($vehicle) {
                $vehicle->update($vehicleData);
                return response()->json(['message' => 'Vehicle updated successfully']);
            }
            return response()->json(['message' => 'Vehicle not found for update'], 404);
        } else {
            $vehicle = new UserVehicle($vehicleData);
            $user->vehicles()->save($vehicle);
            return response()->json(['message' => 'Vehicle added successfully']);
        }
    }

    public function deleteVehicle(Request $request): JsonResponse
    {
        $vehicleId = $request->input('vehicle_id');
        $vehicle = auth()->user()->vehicles->find($vehicleId);

        if ($vehicle) {
            $vehicle->delete();
            return response()->json(['message' => 'Vehicle deleted successfully']);
        }

        return response()->json(['message' => 'No vehicle found to delete'], 404);
    }

}

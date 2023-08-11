<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserVehicleRequest;
use App\Models\UserVehicle;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserVehicleController extends Controller
{

    public function createVehicle()
    {
        return view('pages.create-vehicle');
    }

    public function editProfile($vehicleId)
    {
        $user = auth()->user();
        $vehicle = $user->vehicles->find($vehicleId);

        if (!$vehicle) {
            return redirect()->back();
        }

        return view('pages.edit-vehicle')->with(['user' => $user, 'vehicle' => $vehicle]);
    }

    public function saveVehicle(AddUserVehicleRequest $request): RedirectResponse
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
            // Update existing vehicle
            $vehicle = $user->vehicles->find($vehicleId);
            if ($vehicle) {
                $vehicle->update($vehicleData);
                return back()->with('success', 'Vehicle info updated !');
            }
            return back()->with('error', 'Vehicle not found for update');
        } else {
            // Create new vehicle
            $vehicle = new UserVehicle($vehicleData);
            $user->vehicles()->save($vehicle);
            return back()->with('success', 'Vehicle added successfully');
        }
    }


    public function deleteVehicle($vehicleId): RedirectResponse
    {

        $vehicle = auth()->user()->vehicles->find($vehicleId);

        if ($vehicle) {
            $vehicle->delete();
            return redirect()->back();
        }
        return back()->with(['message' => 'No vehicle found to delete'], 200);
    }

}

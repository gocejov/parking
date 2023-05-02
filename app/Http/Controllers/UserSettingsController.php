<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserSettingsController extends Controller
{
    public function index(Request $request): Mixed
    {
        $user = auth()->user();
        // $userId = auth()->user()->id;
        $userId = $user->id;

        $userSettings = UserSettings::where('user_id', $userId)->get();

        if ($request->expectsJson()) {
            return response()->json([
                'userSettings' => $userSettings
            ]);
        }
        return view('user-settings.index', compact('userSettings',));
    }

    public function store(Request $request): Mixed
    {
        $user = auth()->user();
        $settings = $user->settings()->create([
            'license_plate' => $request->input('license_plate'),
            'default_park_time' => $request->input('default_park_time'),
            'phone_number' => $request->input('phone_number'),
            'location' => $request->input('location')
        ]);
        if ($request->expectsJson()) {
            return response()->json($settings);
        }
        return redirect()->route('settings.index')->with('success', 'Settings created successfully');
    }

    public function create(): View
    {
        return view('user-settings.create');
    }

    public function edit(UserSettings $settings): View
    {
        return view('user-settings.edit', compact('settings'));
    }

    public function update(Request $request, UserSettings $settings): Mixed
    {
        $settings->update([
            'license_plate' => $request->input('license_plate'),
            'default_park_time' => $request->input('default_park_time'),
            'phone_number' => $request->input('phone_number'),
            'location' => $request->input('location')
        ]);
        if ($request->expectsJson()) {
            return response()->json($settings);
        }
        return redirect()->route('settings.index')->with('success', 'Settings updated successfully');
    }

    public function destroy(Request $request, UserSettings $settings): Mixed
    {
        $settings->delete();
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Settings deleted successfully']);
        }
        return redirect()->route('settings.index')->with('success', 'Settings deleted successfully');
    }
}

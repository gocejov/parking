<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
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
        return view('pages.dashboard', ['userSettings' => $userSettings]);
    }
}

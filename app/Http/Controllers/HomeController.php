<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $userSettings = UserSettings::where('user_id', Auth::user()->id)->with('zone')->get();
        if ($request->expectsJson()) {
            return response()->json([
                'userSettings' => $userSettings
            ]);
        }
        return view('pages.dashboard', ['userSettings' => $userSettings]);
    }
}

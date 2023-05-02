<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    // Api Login
        public function apiLogin(LoginUserRequest $request): JsonResponse
        {
            $credentials = $request->validated();


            if (Auth::attempt($credentials)) {
                $user = $request->user();
    //            $token = $user->createToken('API Token')->plainTextToken;
                $token = $user->createToken('Auth Token')->accessToken;

                return response()->json([
                    "user" => $user,
                    'accessToken' => $token,
                ]);
            }
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

    // Web Login
    public function login(LoginUserRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

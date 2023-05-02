<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    // Api Registration
    public function apiStore(RegisterUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'terms' => $validatedData['terms'],
        ]);

        return response()->json($user);
    }

    // Web Registration

    public function store(RegisterUserRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        $user = User::create([
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'terms' => $attributes['terms'],
        ]);
        auth()->login($user);

        return redirect('/dashboard');
    }
}

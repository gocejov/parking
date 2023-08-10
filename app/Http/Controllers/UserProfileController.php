<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Http\JsonResponse;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }

    public function update(UpdateUserProfileRequest $request)
    {
        $this->updateUserProfile($request);

        return back()->with('success', 'Profile successfully updated');
    }

    public function apiUpdate(UpdateUserProfileRequest $request): JsonResponse
    {
        $this->updateUserProfile($request);

        return response()->json([
            'message' => 'Profile successfully updated',
            'data' => auth()->user()
        ]);
    }

    /**
     * @param UpdateUserProfileRequest $request
     * @return void
     */
    private function updateUserProfile(UpdateUserProfileRequest $request): void
    {
        $user = auth()->user();

        $user->update($request->validated());
    }


}

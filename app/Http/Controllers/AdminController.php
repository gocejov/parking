<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function userManagement()
    {
        // Retrieve roles and users with their roles
        $roles = Role::all();
        $users = User::with('roles')->get();
        return view('management.user-management', compact('roles', 'users'));
    }

    public function createUser()
    {
        return view('management.create-user');
    }

    public function editUser(User $user)
    {
        return view('management.edit-user');
    }


    public function saveUser(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the request data
        $rules = [
            'username' => 'required|string|max:50',
            'firstname' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $userId = $request->input('user_id');
        if ($userId) {
            $rules['email'] .= ",$userId"; // Allow the email to stay the same for the current user
        } else {
            $rules['email'] .= '|unique:users,email'; // Enforce unique email for new users
        }

        $request->validate($rules);

        $userData = [
            'username' => $request->input('username'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
        ];

        if ($request->has('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        }

        if ($userId) {
            // Editing an existing user
            $user = User::findOrFail($userId);
            $user->update($userData);

            // Update roles if selected
            if ($request->has('roles')) {
                $selectedRoles = $request->input('roles');
                $roles = Role::whereIn('name', $selectedRoles)->get();
                $user->syncRoles($roles);
            }

            return back()->with('success', 'User updated successfully.');
        } else {
            // Creating a new user
            $user = User::create($userData);

            // Assign roles if selected
            if ($request->has('roles')) {
                $selectedRoles = $request->input('roles');
                $roles = Role::whereIn('name', $selectedRoles)->get();
                $user->assignRole($roles);
            }

            return back()->with('success', 'User created successfully.');
        }
    }


    public function deleteUser(User $user): \Illuminate\Http\RedirectResponse
    {
        $user->roles()->detach();

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}

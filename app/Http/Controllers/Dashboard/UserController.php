<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.pages.users.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            // Add other validation rules as needed
        ]);

        // Create a new user
        User::create($request->all());

        return redirect()->route('dashboard.pages.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('dashboard.pages.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('dashboard.pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Add other validation rules as needed
        ]);

        // Update the user
        $user->update($request->all());

        return redirect()->route('dashboard.pages.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.pages.users.index')->with('success', 'User deleted successfully.');
    }
}

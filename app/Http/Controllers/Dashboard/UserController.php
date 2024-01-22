<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.users.index');
    }

    public function create()
    {
        return view('dashboard.pages.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('dashboard.users.index')->with('success', 'User created successfully.');
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
        $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email,' . $user->id,
            'status' => 'required|in:1,2,3,4',
            'role' => 'required|in:1,2,3',
        ]);

        $user->update($request->all());

        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully.');
    }

    public function banUser(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        $user = User::findOrFail($id);

        $user->update(['status' => 3]);

        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully.');
    }

    public function deleteImage($id)
    {
        $user = User::findOrFail($id);
        if ($user->profile_image != null) {
            Storage::delete('profile-images/' . $user->profile_image);
        }
        $user->update(['profile_image' => null]);

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}

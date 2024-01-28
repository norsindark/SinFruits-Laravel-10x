<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;



class UsersController extends Controller
{

    // index
    public function index()
    {
        $userId = Auth::user()->id;
        $orders = Order::where('user_id', $userId)->paginate(6);
        return view('client.pages.users.profile', compact('orders'));
    }


    // update name - email
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    // update password
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'password-updated');
    }


    // update address - phone
    public function updateAddress(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'digits:10'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = $request->user();
        $user->update([
            'address' => $validator->validated()['address'],
            'phone' => $validator->validated()['phone'],
        ]);

        return back()->with('success', 'address - phone number updated');
    }


    // update image
    public function updateImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('profile-images', $imageName, 'public');

            auth()->user()->update(['profile_image' => $imageName]);

            return redirect()->back()->with('success', 'image-updated');
        }

        return back()->withErrors(['profile_image' => 'Failed to upload image.']);
    }


    // logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.home.index');
    }
}

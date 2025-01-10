<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    function show(User $user) {
        return view('profile.show', compact('user'));
    }

    function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'heading' => 'required',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->heading = $request->heading;
        $user->intro = $request->intro;
        $user->save();

        flash('Your profile updated successfully')->success();
        return back();
    }

    function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();
        if (!password_verify($request->current_password, $user->password)) {
            $validator = Validator::make([], []);
            $validator->errors()->add('current_password', 'Current password is incorrect');

            return back()->withErrors($validator)->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        flash('Password updated successfully')->success();
        return back();
    }

    function updateimage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();
        $image = $request->file('profile_image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('storage/profile/personal'), $imageName);

        $user->profile_picture = $imageName;
        $user->save();

        flash('Profile image updated successfully')->success();
        return back();
    }

    function updatecover(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();
        $image = $request->file('cover_image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('storage/profile/cover'), $imageName);

        $user->cover_image = $imageName;
        $user->save();

        flash('Cover picture updated successfully')->success();
        return back();
    }

    function deleteAccount()
    {
        $user = auth()->user();
        $user->delete();

        auth()->logout();
        flash('Account deleted successfully')->success();
        return redirect()->route('login');
    }

    function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

}

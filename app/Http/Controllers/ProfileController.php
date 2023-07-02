<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin', 'role:user']);
    }
    public function view()
    {
        // Retrieve the authenticated user's profile data
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user = Auth::user();

            // Check if the current password matches
            if (Hash::check($request->current_password, $user->password)) {
                // Update the user's password
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success', 'Password changed successfully.');
            }

            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        return view('profile.password');
    }

    public function changeUsername(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'new_name' => 'required|unique:users,name',
                'confirm_new_name' => 'required|same:new_name',
                'current_name' => 'required',
            ]);

            $user = Auth::user();

            // Check if the current username matches
            if ($request->current_name !== $user->name) {
                return redirect()->back()->withErrors(['current_name' => 'The current name is incorrect.']);
            }

            // Update the user's name
            $user->name = $request->new_name;
            $user->save();

            return redirect()->back()->with('success', 'Name changed successfully.');
        }

        return view('profile.username');
    }

    public function changeEmail(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'new_email' => 'required|email|unique:users,email',
                'new_email_confirmation' => 'required|email|same:new_email',
                'current_email' => 'required|email',
            ]);

            $user = Auth::user();

            // Check if the current email matches
            if ($request->current_email !== $user->email) {
                return redirect()->back()->withErrors(['current_email' => 'The current email is incorrect.']);
            }

            // Update the user's email
            $user->email = $request->new_email;
            $user->save();

            return redirect()->back()->with('success', 'Email changed successfully.');
        }

        return view('profile.email');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.changePassword.index');
    }

    public function changePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        // old password match...
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("error", "Old password is incorrect.");
        }
        // Update the new Password....
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        return back()->with('success', 'Password updated successfully.');
    }
}

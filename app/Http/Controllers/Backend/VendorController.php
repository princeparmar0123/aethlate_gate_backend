<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $data = User::where('type', 'vendor')
            ->orderBy('is_approved', 'asc')
            ->with(['locations', 'complexes', 'complexes.sport', 'complexes.images', 'packages'])
            ->get();
        return view('backend.vendor.index', compact('data'));
    }

    public function vendorDetails(User $user){
        $data = $user->where('type', 'vendor')->where('id', $user->id)
            ->with(['locations', 'complexes', 'complexes.sport', 'complexes.images', 'packages'])
            ->get();
            return view('backend.vendor.details', compact('data'));
    }

    public function approvalStatus($status, User $user)
    {
        if (!in_array($status, [0, 1])) {
            return redirect()->back()->withErrors(['status' => 'Invalid status value.']);
        }
        // Update the user's approval status
        $user->is_approved = $status;
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'User approval status updated.');
    }
}

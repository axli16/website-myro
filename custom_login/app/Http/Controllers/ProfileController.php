<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }
    public function upload(Request $request)
{
    if ($request->hasFile('profile_picture')) {
        $user = auth()->user();
        $profilePicPath = $request->file('profile_picture')->store('profile_pics', 'public');
        $user->profile_pic = asset('storage/' . $profilePicPath);
        $user->save();
    }
    
    return redirect()->back();
}
}

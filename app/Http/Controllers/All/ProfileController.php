<?php

namespace App\Http\Controllers\All;

use App\Models\User;
use App\Models\TmpImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        if($user->hasRole(1)) 
        {
            return view('admin.profile.edit', compact('user'));
        }

        return view('user.profile.edit', compact('user'));
        
    }

    public function update(User $user, Request $request)
    {
        $data = $request->validate(['password' => 'nullable|min:6|max:15']);

        if($request->avatar)
        {
            $user->avatar ? $user->avatar->delete() : '';
            $user->addMedia(storage_path('app/public/tmp/'. request('avatar')))->toMediaCollection('avatar_image');
            TmpImage::where('filename', $request->avatar)->delete(); // get the tmp image from the db
        }

        if($data) 
        {
            $user->update(['password' => Hash::make($data['password'])]); // update password [hashed]
        }

        return back()->with(['message' => 'Profile Updated Successfully']);
    }
}

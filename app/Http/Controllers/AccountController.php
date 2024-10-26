<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index($username)
    {
        $user = auth()->user();
        return view('studio.profile.account', [
            'title' => 'Account',
            'user' => $user,
        ]);
    }

    public function update(Request $request, $username)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'image' => 'image',
            'name' => 'min:5|max:200',
        ]);
        
        if($request->file('image')) {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('user-images');
        }
        
        else {
            if ($request->oldImage && $request->oldImage != $user->image) {
                Storage::delete($request->oldImage);
                $validatedData['image'] = null;
            }
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect('/' . $user->username . '/account');
    }

    public function deleteImage()
    {
        $user = auth()->user();

        if($user->image) {
            Storage::delete($user->image);
        }

        $user->update(['image' => null]);

        return redirect('/' . $user->username . '/account');
    }
}

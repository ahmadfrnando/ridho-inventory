<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {   
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required'
        ]);
        if($request->password != $request->confirm_password){
            return redirect()->route('ubah-password')->with('error', 'Password dan konfirmasi password tidak sama');
        } else {
            
            $user = User::findorfail(Auth::user()->id);
            $user->update(['password' => Hash::make($request->confirm_password)]);
            return redirect()->route('ubah-password')->with('success', 'Password berhasil diubah');
        }
        
    }
}
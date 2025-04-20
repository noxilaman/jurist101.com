<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(User $user, Request $request)
    {   

        if(!empty($request->name)){
            $user->update([
                'name' => $request->name,
                'updated_at' => now()
            ]);
        }
    
        if(!empty($request->email)){
            $user->update([
                'email' => $request->email,
                'updated_at' => now()
            ]);
        }

        if(!empty($request->password)){
            $user->update([
                'password' => Hash::make($request->password),
                'updated_at' => now()
            ]);
        }
        
        
        return redirect('/home');
    }
}

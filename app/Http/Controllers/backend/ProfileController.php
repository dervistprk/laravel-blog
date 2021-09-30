<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function adminProfile(){
        $admin = Admins::first();
        return view('backend.profile', compact('admin'));
    }

    public function adminPost(Request $request){
        $request->validate([
                               'name'     => 'required|min:3',
                               'email'    => 'email|required',
                               'password' => 'required|min:5',
                           ]);
        $admin           = Admins::first();
        $admin->name     = $request->name;
        $admin->email    = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
        toastr()->success('Yönetici bilgileri başarıyla güncellendi.');
        return redirect()->back();
    }
}

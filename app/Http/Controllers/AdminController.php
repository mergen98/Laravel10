<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function adminDashboard(){
        return view('admin.index');
    }
    
    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }
    public function adminLogin(){
        return view('admin.admin_login');
    }
    
    public function adminProfile(){
        $id = Auth::user()->id;
        $profileData = \App\Models\User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));
    }
    
    public function adminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = \App\Models\User::find($id);
    
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        
        if ($request->photo) {
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;
        }
        
        $data->save();
        return redirect()->back();
    }

}

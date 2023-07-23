<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

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
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();
        
        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function adminChangePassword(){
        $id = Auth::user()->id;
        $profileData = \App\Models\User::find($id);
        return view('admin.admin_change_password',compact('profileData'));
    }
    public function adminUpdatePassword(Request $request){
        $request->validate([
           'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = [
                'message' => 'Old Password is Wrong',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }
        
        User::whereId(Auth::user()->id)
            ->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = [
            'message' => 'Old Password is Updated Successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }
}

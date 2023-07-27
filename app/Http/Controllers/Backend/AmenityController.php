<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function AllAmenity(){
        $amenity = Amenity::latest()->get();
        return view('backend.amenities.all_amenity',compact('amenity'));
    }
    
    public function AddAmenity(){
        return view('backend.amenities.add_amenity');
    }
    
    public function StoreAmenity(Request $request){
        $validation = $request->validate([
            'amenity_name' => 'required|unique:amenities|max:200',
        ]);
        Amenity::insert([
            'amenity_name' => $request->amenity_name,
        ]);
        $notification = [
            'message' => 'Amenity Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.amenity')->with($notification);
    }
    public function EditAmenity($ids){
        $amenity = Amenity::findOrFail($ids);
        return view('backend.amenities.edit_amenity',compact('amenity'));
    }
    public function UpdateAmenity(Request $request){
        $id = $request->id;
    
        Amenity::findOrFail($id)->update([
            'amenity_name' => $request->amenity_name,
        ]);
        $notification = [
            'message' => 'Amenity Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.amenity')->with($notification);
    }
    
    public function DestroyAmenity($id){
        Amenity::findOrFail($id)->delete();
        $notification = [
            'message' => 'Amenity Delete Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
        
    }
}

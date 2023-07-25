<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function AllType(){
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type',compact('types'));
    }
    
    public function AddType(){
        return view('backend.type.add_type');
    }
    
    public function StoreType(Request $request){
        $validation = $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);
        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
            ]);
        $notification = [
            'message' => 'Property Type Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.type')->with($notification);
    }
    public function EditType($ids){
        $type = PropertyType::findOrFail($ids);
        return view('backend.type.edit_type',compact('type'));
    }
    public function UpdateType(Request $request){
        $id = $request->id;
    
        PropertyType::findOrFail($id)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = [
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.type')->with($notification);
    }
    
    public function DestroyType($id){
        PropertyType::findOrFail($id)->delete();
        $notification = [
            'message' => 'Property Type Delete Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
       
    }
}

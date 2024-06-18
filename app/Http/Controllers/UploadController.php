<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
   public function upload(Request $request){

    return view('file.uploadImage');
   }

   public function store(Request $request){
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
    ]);

    $imageName = time().'.'.$request->image->extension();  
    $imagePath = public_path('images') . '/' . $imageName;
    $request->image->move(public_path('images'), $imageName);
    return back()
        ->with('success','You have successfully upload image.')
        ->with('image',$imageName);
   }
}

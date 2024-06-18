<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;

class UploadController extends Controller
{
   public function upload(Request $request){
    $files = Files::all();
    return view('file.uploadImage', ['files'=> $files]);
   }

   public function store(Request $request){
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
    ]);

    $imageName = time().'.'.$request->image->extension();  
    $imagePath = 'images' . '/' . $imageName;
    $file  = new Files();
    $file->image = $imagePath;
    $file->save();
    $request->image->move(public_path('images'), $imageName);
    return back()
        ->with('success','You have successfully upload image.')
        ->with('image',$imageName);
   }
}

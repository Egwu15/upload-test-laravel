<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\PostTooLargeException;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $files = Files::all();
        return view('file.uploadImage', ['files' => $files]);
    }


    public function store(Request $request)
    {

        try {
            $request->validate([
                'image' => 'required|max:55000',
            ]);
        } catch (PostTooLargeException $e) {

            return back()
                ->with('error', 'File size is too large. Max file size is 55MB');
        }


        $imageName = time() . '.' . $request->image->extension();
        $imagePath = 'file' . '/' . $imageName;
        $file  = new Files();
        $file->image = $imagePath;

        $file->save();

        $request->image->move(public_path('images'), $imageName);
        return back()
            ->with('success', 'You have successfully upload image.');
    }

    public function destroy($id)
    {
        $file = Files::find($id);
        $file->delete();
        return redirect('/file');
    }
}

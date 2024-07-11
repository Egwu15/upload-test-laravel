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

        // try {
        $request->validate([
            'file' => 'required',
            'fileName' => 'required',
        ]);
        // } catch (PostTooLargeException $e) {

        // return back()
        //     ->with('error', 'File size is too large. Max file size is 55MB');
        // }




        // Original file extension
        $originalExtension = $request->file->getClientOriginalExtension();

        $isApk = $originalExtension === 'apk' || $request->file->getMimeType() === 'application/vnd.android.package-archive';


        $fileExtension = $isApk ? 'apk' : $request->file->extension();

        $imageName = $request->fileName . time() . '.' . $fileExtension;

        $imagePath = "files/$imageName";
        $file  = new Files();
        $file->fileLink = $imagePath;
        $file->fileName = $request->fileName;
        $file->save();

        $request->file->move(public_path('files'), $imageName);
        return back()
            ->with('success', 'You have successfully upload image.');
    }

    public function destroy($id)
    {
        $file = Files::find($id);
        if (!$file) {
            return redirect('/file');
        }

        $filePath = public_path($file->fileLink);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $file->delete();
        return redirect('/file');
    }
}

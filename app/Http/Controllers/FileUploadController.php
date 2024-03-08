<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers;

class FileUploadController extends Controller
{
    public function uploadFile(Request $request,$task_id){
        $request->validate([
            'document' => 'required',
        ]);
        // dd($request->file('document')->getClientOriginalName());
        $path = $request->file('document')->storeAs('documents/'.$task_id, $request->file('document')->getClientOriginalName() );
        return redirect()->back();
    }

    public function getAllFiles($task_id){
        return Storage::files("documents/{$task_id}");
    }

    public function download($id, $filename)
    {
        $file = "documents/{$id}/{$filename}";
        if (Storage::exists($file)) {
            return Storage::download($file);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function delete($id, $filename)
    {
        $file = "documents/{$id}/{$filename}";
        if (Storage::exists($file)) {
            Storage::delete($file);
        return redirect()->back();
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }


    
}

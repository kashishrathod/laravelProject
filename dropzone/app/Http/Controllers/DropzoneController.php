<?php

namespace App\Http\Controllers;

use App\Dropzone;
use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function getDropzoneView() {
        return view('dropzone.file-upload');
    }

    public function getListing() {
        $all_data = Dropzone::get();
        return view('dropzone.file-listing', compact('all_data'));
    }

    public function store(Request $request)
    {
        
    }
    
    public function save(Request $request) {
        if($request->has('file')) {
            $image = $request->file('file');
            $avatarName = $image->getClientOriginalName();
            $image->move(public_path('images'),$avatarName);
            
        }
        if ($request->doc) {
            foreach($request->doc as $key => $file) {
                $imageUpload = new Dropzone();
                $imageUpload->file_url = $key;
                $imageUpload->save();
                return response()->json(['success'=>$key]);
            }
            
        } else {
            if ($request->documents) {
                foreach($request->documents as $key => $file) {
                    $imageUpload = new Dropzone();
                    $imageUpload->file_url = $key;
                    $imageUpload->save();
                    return response()->json(['success'=>$key]);
                }
                
            }
        }
    }

    public function edit($id) {
        $edit_data = Dropzone::find($id);
        return view('dropzone.file-edit', compact('edit_data'));
    }

    public function editDocument(Request $request, $id) {
        //dd($id);
        $update = Dropzone::find($id);
        $update->file_url = $request->input;
        $update->save();
    }

    public function deleteDocument($id) {
        $image = Dropzone::find($id);
        $url = public_path('images/'.$image->file_url);
        unlink($url);
        Dropzone::find($id)->delete();
    }
}

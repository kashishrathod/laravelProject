<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Gallery_model;
use App\Gallery_image_model;
use App\Search_index_model;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Support\Facades\Storage;
use FFMpeg;
use Image;

class UploadController extends Controller
{
    public function upload() {
        return view('index');
    }

    public function uploadLarge(Request $request) {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
        }
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            $file = $save->getFile();
            $extension = $file->getClientOriginalExtension();
            $file_name = str_replace(".".$extension, "", $file->getClientOriginalName());
            $file_name .= "_" . md5(time()) . "." . $extension;
            $disk = Storage::disk('local')->put($file_name, $file);
            //$path = $disk->put('videos', $file, $file_name);disk('local')->put($file_name, $the_file);
            unlink($file->getPathname());
            
            return [
                'path' => asset('storage/'.$disk),
                'filename' => $file_name,
            ];
        }

        $handler = $save->handler();
        return [
            "done" => $handler->getPercentageDone(),
            'status' => true,
        ];
    }
}

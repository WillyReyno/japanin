<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;



namespace App\Http\Controllers;


use App\Models\Fileentry;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller {


    function imageUpload($field, $optionals = false) {
        // Upload File
        $file = Request::file($field);
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension, File::get($file));
        $entry = new Fileentry();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;
        $entry->save();
        if($optionals) {
            return $return = $file->getFilename().'.'.$extension;
        }
    }
}
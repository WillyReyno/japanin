<?php namespace App\Http\Controllers;

use App\Models\Fileentry;
use App\Http\Controllers\Controller;
use \Request;
use \File;
use \Storage;
use Illuminate\Http\Response;

class FileEntryController extends Controller {

//	public function index()
//    {
//        $entries = Fileentry::all();
//
//        return view('fileentries.index', compact('entries'));
//    }

//    public function add()
//    {
//        $file = Request::file('poster');
//        $extension = $file->getClientOriginalExtension();
//        Storage::disk('local')->put($file->getFilename().'.'.$extension, File::get($file));
//        $entry = new Fileentry();
//        $entry->mime = $file->getClientMimeType();
//        $entry->original_filename = $file->getClientOriginalName();
//        $entry->filename = $file->getFilename().'.'.$extension;
//
//        $entry->save();
//
//        return redirect('fileentry');
//    }

    public function get($filename)
    {
        $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return (new Response($file, 200))
            ->header('Content-Type', $entry->mime);
    }

}

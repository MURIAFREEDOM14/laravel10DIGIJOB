<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use ZipArchive;


class FileUploadController extends Controller
{
    public function __invoke()
    {
        $zip = new ZipArchive;
    
        $fileName = 'myNewFile.zip';
     
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path('myFiles'));
     
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
               
            $zip->close();
        }
      
        return response()->download(public_path($fileName));
    }
}

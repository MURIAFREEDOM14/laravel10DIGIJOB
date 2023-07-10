<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Symfony\Component\HttpFoundation\Response;
use ZipArchive;


class FileUploadController extends Controller
{
    public function downloadFile()
    {
        $file = new ZipArchive;
        $fileName = time().'.zip';
        if ($file->open(public_path($fileName),ZipArchive::CREATE) === true) {
            $zip = File::files(public_path('gambar'));   
            
            foreach($zip as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $file->addFile($value,$relativeNameInZipFile);
            }
            $file->close();
        }
        return Response()->download(public_path($fileName));
    }
}

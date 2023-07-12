<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use PDF;
use Mail;
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

    public function sendEmailFile()
    {
        $data['email'] = "strikefreedomfalken14@gmail.com";
        $data['title'] = "Prototest";
        $data['body'] = "This is Demo";

        $pdf = PDF::loadView('output.output_izin_waris',$data);

        Mail::send('output.output_izin_waris', $data, function($message) use($data, $pdf) {
            $message->to($data['email'])
                    ->subject($data['title'])
                    ->attachData($pdf->output(), "Teks_PDF");
        });

        dd('Mail send successfully');
    }
}

@extends('layouts.kandidat')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <b class="bold">Jadwal Interview Perusahaan</b>
        </div>
        <div class="card-body">
            <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase;">Data kandidat</div>
            <div class="row my-3" style="text-transform: uppercase;">
                <div class="col-md-2">
                    <label for="" class="" style="font-weight:700">Nama Kandidat</label>
                </div>
                <div class="col-md-6">
                    <label for="" class="">| {{$interview->nama}}</label>
                </div>
                <div class="col-md-2">
                    <label for="" class="">| {{$interview->usia}} Tahun</label>
                </div>
                <div class="col-md-2">
                    <label for="" class="">| 
                        @if ($interview->jenis_kelamin == "M")
                            Laki-laki
                        @else
                            Perempuan
                        @endif
                    </label>
                </div>
            </div>
            <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase;">Jadwal Interview</div>
            <div class="row my-3" style="text-transform: uppercase;">
                <div class="col-md-3">
                    <label for="" class="" style="font-weight:700">Tanggal Interview</label>
                </div>
                <div class="col-md-9">
                    <label for="" class="">: {{date('d M Y',strtotime($interview->jadwal_interview))}}</label>
                </div>
            </div>
            <div class="row my-3" style="text-transform:uppercase;">
                <div class="col-md-3">
                    <label class="" style="font-weight:700">Waktu Interview</label>
                </div>
                <div class="col-md-9">
                    <label class="">: {{date('h:i:s a',strtotime($interview->waktu_interview_awal))}} Sampai {{date('h:i:s a',strtotime($interview->waktu_interview_akhir))}}</label>
                </div>
            </div>
            <div class="row my-3" style="text-transform: uppercase;">
                <div class="col-md-3">
                    <label for="" class="" style="font-weight:700">Status</label>
                </div>
                <div class="col-md-9">
                    <label for="" class="">: 
                        @if ($interview->status == "terjadwal")
                            Belum Interview
                        @elseif($interview->status == "dimulai")
                            Sedang Interview
                        @elseif($interview->status == "berakhir")
                            Sudah Interview
                        @endif                  
                    </label>
                </div>
            </div>
            @php
                $tgl_now = date('d M Y');
                $tgl_interview = date('d M Y',strtotime($interview->jadwal_interview));
                $time_now = date('h:i:s a');
                $time_interview_begin = date('h:i:s a',strtotime($interview->waktu_interview_awal.('-15 minutes')));
                $time_interview_ended = date('h:i:s a',strtotime($interview->waktu_interview_akhir));
            @endphp
            @if($tgl_now == $tgl_interview && $time_now > $time_interview_begin)
                @if ($time_now > $time_interview_ended)
                    <label for="" class="form-label">Waktu interview anda dengan perusahaan ini telah habis. Mohon tunggu keputusan dari pihak perusahaan.</label>
                @else    
                    <label for="" class="form-label">Interview anda dengan kandidat akan segera dimulai. Harap segera masuk ke dalam portal</label>
                    <a class="float-right btn btn-outline-success" style="padding: 10px; text-decoration:none; border:1px solid green; border-radius:0% 20% 0% 20%" href="">Masuk Portal</a>
                @endif
            @endif
            <hr>
            <b>Catatan</b>
            <div class="">Harap untuk menyegarkan halaman ini / masuk kembali ke halaman ini apabila waktu interview akan segera dimulai.</div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4><b class="bold">Jadwal Interview Kandidat</b></h4>
        </div>
        <div class="card-body">
            <div class="" id="scrollInterview">
                @foreach ($kandidat as $item)
                    <div class="card">
                        @if ($item->persetujuan == null)
                            <small class="text-white" style="background-color:#FF6969; padding:5px; border-radius:0% 20% 0% 20%; width:28%"><i class="fas fa-clock">&nbsp;</i>Menunggu Persetujuan Kandidat
                                <button type="button" style="border-radius: 50%; border:0.5px solid lightblue; background-color:white;" class="" data-toggle="tooltip" data-placement="right" title="Apabila kandidat belum menyetujui undangan interview sampai 5 menit sebelum waktu interview dimulai, maka kandidat akan dianggap menolak dari interview.">
                                    ?
                                </button>
                            </small>
                        @else
                            <small class="text-white" style="background-color:#7EAA92; padding:5px; border-radius:0% 20% 0% 20%; width:28%"><i class="fas fa-check-circle">&nbsp;</i>Kandidat Menyetujui</small>                            
                        @endif
                        <div class="card-body">
                            <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase;background-image: linear-gradient(#0C356A, #279EFF);color:white;">Data kandidat</div>
                            <div class="row my-3" style="text-transform: uppercase;">
                                <div class="col-md-2">
                                    <label for="" class="" style="font-weight:700">Nama Kandidat</label>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="">| {{$item->nama}}</label>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="">| {{$item->usia}} Tahun</label>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="">| 
                                        @if ($item->jenis_kelamin == "M")
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase; background-image: linear-gradient(#0C356A, #279EFF);color:white;">Jadwal Interview</div>
                            <div class="row my-3" style="text-transform: uppercase;">
                                <div class="col-md-3">
                                    <label for="" class="" style="font-weight:700">Tanggal Interview</label>
                                    <br>
                                    <label class="" style="font-weight:700">Waktu Interview</label>
                                    <br>
                                    <label for="" class="" style="font-weight:700">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <label for="" class="">: {{date('d M Y',strtotime($item->jadwal_interview))}}</label>
                                    <br>
                                    <label class="">: {{$item->waktu_interview_awal}} Sampai {{$item->waktu_interview_akhir}}</label>
                                    <br>
                                    <label for="" class="">: 
                                        @if ($item->status == "terjadwal")
                                            Belum Interview
                                        @elseif($item->status == "dimulai")
                                            Sedang Interview
                                        @elseif($item->status == "berakhir")
                                            Sudah Interview
                                        @endif
                                    </label>    
                                </div>
                            </div>
                            @php
                                $tgl_now = date('d M Y');
                                $tgl_interview = date('d M Y',strtotime($item->jadwal_interview));
                                $time_now = date('h:i:s a');
                                $time_interview_begin = date('h:i:s a',strtotime($item->waktu_interview_awal.('-15 minutes')));
                                $time_interview_ended = date('h:i:s a',strtotime($item->waktu_interview_akhir));
                            @endphp
                            @if($tgl_now >= $tgl_interview && $time_now > $time_interview_begin)
                                @if ($time_now > $time_interview_ended)
                                    <label for="" class="form-label">Waktu interview anda dengan kandidat ini telah habis.</label>
                                @else    
                                    <label for="" class="form-label">Interview anda dengan kandidat akan segera dimulai. Harap segera masuk ke dalam portal</label>
                                    <a class="float-right btn btn-outline-success" style="padding: 10px; text-decoration:none; border:1px solid green; border-radius:0% 20% 0% 20%" href="">Masuk Portal</a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <b>Catatan</b>
            <div class="">Harap untuk menyegarkan halaman ini / masuk kembali ke halaman ini apabila waktu interview akan segera dimulai.</div>
        </div>
    </div>
    {{-- @if ($kandidat_berakhir->count() !== 0) --}}
        <div class="card">
            <div class="card-header">
                <b class="bold">Penentuan Kandidat</b>
            </div>
            <div class="card-body">
                {{-- @foreach ($kandidat_berakhir as $data) --}}
                @foreach ($kandidat as $data)
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="" style="text-transform: uppercase; font-weight:400;">Nama Kandidat</label>
                            <br>
                            {{-- <label for="" style="text-transform: uppercase; font-weight:400">Status</label> --}}
                        </div>
                        <div class="col-md-8">
                            <label for="" style="font-weight: 400; text-transform:uppercase;" class="">{{$data->nama}}</label>
                            <br>
                            {{-- <label for="" style="font-weight: 400; text-transform:uppercase">{{$data->status}}</label> --}}
                        </div>
                    </div>                    
                @endforeach
                @if ($kandidat->count() !== 0)
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-outline-primary float-right mt-2" style="border-radius: 0% 20% 0% 20%" href="/perusahaan/seleksi_kandidat/{{$id}}">Tentukan Kandidat</a>
                            <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-danger mt-2 float-left">Kembali</a>
                        </div>
                    </div>    
                @endif
            </div>
        </div>    
    {{-- @endif --}}
</div>    
@endsection
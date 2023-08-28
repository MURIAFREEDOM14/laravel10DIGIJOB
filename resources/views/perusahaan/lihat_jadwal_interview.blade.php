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
                        <div class="card-body">
                            <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase;">Data kandidat</div>
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
                            <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase;">Jadwal Interview</div>
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
                                $now = now();
                            @endphp
                            @if (date('d M Y',strtotime($item->jadwal_interview)) == date('d M Y',strtotime($now)) && date('h:i:s',strtotime($item->waktu_interview_awal.'-15 minutes')) == date('h:i:s',strtotime($now)))
                                <label for="" class="form-label">Interview anda dengan kandidat akan segera dimulai. Harap segera masuk ke dalam portal</label>
                                <a class="float-right btn btn-outline-success" style="padding: 10px; text-decoration:none; border:1px solid green; border-radius:0% 20% 0% 20%" href="">Masuk Portal</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- @if ($kandidat_berakhir->count() !== 0) --}}
        <div class="card">
            <div class="card-header">
                <b class="bold">Kandidat Selesai Diinterview</b>
            </div>
            <div class="card-body">
                {{-- @foreach ($kandidat_berakhir as $data) --}}
                @foreach ($kandidat as $data)
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="" style="text-transform: uppercase; font-weight:400;">Nama Kandidat</label>
                            <br>
                            <label for="" style="text-transform: uppercase; font-weight:400">Status</label>
                        </div>
                        <div class="col-md-8">
                            <label for="" style="font-weight: 400; text-transform:uppercase;" class="">{{$data->nama}}</label>
                            <br>
                            <label for="" style="font-weight: 400; text-transform:uppercase">{{$data->status}}</label>
                        </div>
                    </div>                    
                @endforeach
                <div class="row">
                    <div class="col">
                        <a class="btn btn-outline-primary float-right" style="border-radius: 20% 0% 20% 0%" href="/perusahaan/seleksi_kandidat/{{$id}}">Seleksi kandidat</a>
                    </div>
                </div>
            </div>
        </div>    
    {{-- @endif --}}
</div>    
@endsection
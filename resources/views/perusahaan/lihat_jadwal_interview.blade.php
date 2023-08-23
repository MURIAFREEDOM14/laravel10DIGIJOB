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
                                    <p class="" style="font-weight:700">Waktu Interview</p>
                                </div>
                                <div class="col-md-9">
                                    <label for="" class="">: {{date('d M Y',strtotime($item->jadwal_interview))}}</label>
                                    <p class="">: {{$item->waktu_interview_awal}} Sampai {{$item->waktu_interview_akhir}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>    
@endsection
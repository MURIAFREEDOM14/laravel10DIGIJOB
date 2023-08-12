@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">List Daftar Lowongan Pekerjaan</b></h4>
            </div>
            <div class="card-body">
                @foreach ($lowongan as $item)
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="border:1px solid green">
                                <div class="card-body text-center">
                                    @if ($item->negara == "Indonesia")
                                        <div class="float-right">Dalam Negeri</div>
                                    @else
                                        <div class="float-right">Luar Negeri</div>
                                    @endif
                                    <h5 style="font-weight: bold;text-transform:uppercase; border-bottom:1px solid black">{{$item->jabatan}}</h5>
                                    <div class="row">
                                        <div class="col-md-3 mb-1">
                                            <a class="btn btn-secondary" style="width: 100%" href="/perusahaan/cari/kandidat">Sesuai ({{0}})</a>
                                        </div>
                                        <div class="col-md-3 mb-1">
                                            <a class="btn btn-primary" style="width: 100%" href="/perusahaan/lihat_permohonan_lowongan/{{$item->id_lowongan}}">Melamar ({{0}})</a>
                                        </div>
                                        <div class="col-md-3 mb-1">
                                            <a class="btn btn-info" style="width: 100%" href="/perusahaan/waktu_interview/{{$item->id_lowongan}}/{{$item->tgl_interview_awal}}">Interview ({{0}})</a>
                                        </div>
                                        <div class="col-md-3 mb-1">
                                            <a class="btn btn-success" style="width: 100%" href="/perusahaan/list/kandidat">Diterima ({{0}})</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                @endforeach
            </div>
        </div>
    </div>
@endsection
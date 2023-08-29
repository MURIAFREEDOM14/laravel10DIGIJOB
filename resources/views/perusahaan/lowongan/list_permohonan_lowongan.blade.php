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
                <div class="row">
                    @foreach ($lowongan as $item)
                        <div class="col-6">
                            <div class="card" style="border:1px solid green">
                                <div class="card-body">
                                    @if ($item->negara == "Indonesia")
                                        <div class="float-right">Dalam Negeri</div>
                                    @else
                                        <div class="float-right">Luar Negeri</div>
                                    @endif
                                    <h5 style="font-weight: bold;text-transform:uppercase; border-bottom:1px solid black">{{$item->jabatan}}</h5>
                                    <div class="">
                                        <div class=" mb-1">
                                            <a class="btn btn-secondary" style="width: 100%" href="/perusahaan/lowongan_kandidat_sesuai/{{$item->id_lowongan}}">Sesuai</a>
                                        </div>
                                        <div class=" mb-1">
                                            <a class="btn btn-primary" style="width: 100%" href="/perusahaan/lihat_permohonan_lowongan/{{$item->id_lowongan}}">Melamar</a>
                                        </div>
                                        <div class=" mb-1">
                                            <a class="btn btn-info" style="width:100%" href="/perusahaan/kandidat_lowongan_dipilih/{{$item->id_lowongan}}">Dipilih</a>
                                        </div>
                                        @if ($interview)
                                            @if ($interview->id_lowongan == $item->id_lowongan && $interview->stats_pembayaran == "sudah dibayar")
                                                <div class=" mb-1">
                                                    <a class="btn btn-warning" style="width: 100%" href="/perusahaan/lihat_jadwal_interview/{{$item->id_lowongan}}">Interview</a>
                                                </div>    
                                            @endif
                                        @endif
                                            
                                        <div class=" mb-1">
                                            <a class="btn btn-success" style="width: 100%" href="/perusahaan/list/kandidat/lowongan/{{$item->id_lowongan}}">Diterima</a>
                                        </div>
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
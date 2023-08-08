@extends('layouts.akademi')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">
        @if ($akademi->nama_kepala_akademi == null)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 style="">Harap lengkapi Profil Akademi anda terlebih dahulu</h5>
                            <a href="/akademi/isi_akademi_data" class="btn btn-outline-primary">Lengkapi Profil</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            Data Perusahaan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Perusahaan</th>
                                            {{-- <th>Logo Perusahaan</th> --}}
                                            <th>Lihat Profil Perusahaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($perusahaan as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td style="text-transform: uppercase">{{$item->nama_perusahaan}}</td>
                                                {{-- <th>
                                                    @if ($item->logo_perusahaan == null)
                                                        <img src="/gambar/default_user.png" width="150" height="150" alt="">
                                                    @else
                                                        <img src="/gambar/Perusahaan/{{$item->nama_perusahaan}}/Logo Perusahaan/{{$item->logo_perusahaan}}" width="150" height="150" alt="">
                                                    @endif
                                                </th> --}}
                                                <td>
                                                    <a href="/akademi/lihat/profil_perusahaan/{{$item->id_perusahaan}}" class="btn btn-info">Lihat</a>
                                                </td>
                                            </tr>                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            Data Kandidat
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Lihat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($akademi_kandidat as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->nama}}</td>
                                                <td>
                                                    <a href="/akademi/kandidat/lihat_profil/{{$item->nama}}/{{$item->id}}" class="btn btn-info">Lihat</a>
                                                </td>
                                            </tr>    
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
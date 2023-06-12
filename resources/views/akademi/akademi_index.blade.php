@extends('layouts.akademi')
@section('content')
    <div class="container mt-5">
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
                                        <th>Logo Perusahaan</th>
                                        <th>Lihat Profil Perusahaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perusahaan as $item)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <th style="text-transform: uppercase">{{$item->nama_perusahaan}}</th>
                                            <th>
                                                @if ($item->logo_perusahaan == null)
                                                    <img src="/gambar/default_user.png" width="150" height="150" alt="">
                                                @else
                                                    <img src="/gambar/Perusahaan/{{$item->nama_perusahaan}}/Logo/{{$item->logo_perusahaan}}" width="150" height="150" alt="">
                                                @endif
                                            </th>
                                            <th>
                                                <a href="/akademi/lihat/profil_perusahaan" class="btn btn-info">Lihat</a>
                                            </th>
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
                                                <a href="/akademi/kandidat/lihat_profil/{{$item->nama}}/{{$item->id_kandidat}}" class="btn btn-info">Lihat</a>
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
        
    </div>
@endsection
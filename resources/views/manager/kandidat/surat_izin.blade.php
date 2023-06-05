@extends('layouts.manager')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-secondary" href="/manager/buat_surat_izin">Buat Surat izin dan ahli waris</a>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No,</th>
                                <th>Nama</th>
                                <th>Lihat Profil</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratIzin as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>
                                        <a href="/manager/kandidat/lihat_profil/{{$item->id_kandidat}}">Lihat Profil</a>
                                    </td>
                                    <td>
                                        <a href="/manager/kandidat/cetak_surat/{{$item->id_kandidat}}">Cetak</a>
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
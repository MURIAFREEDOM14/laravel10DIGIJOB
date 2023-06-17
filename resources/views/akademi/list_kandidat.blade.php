@extends('layouts.akademi')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="" style="text-transform:uppercase;">Data Kandidat</b>
                <a href="/akademi/tambah_kandidat" class="float-right btn text-white" style="background-color: #FF9E27">Tambah Kandidat/Murid</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No. Telp</th>
                                <th>Jenis Kelamin</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kandidat as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->no_telp}}</td>
                                    <td>{{$item->jenis_kelamin}}</td>
                                    <td>
                                        @if ($item->negara_id == null)
                                            <a class="btn btn-warning" href="/akademi/isi_kandidat_document/{{$item->nama}}/{{$item->id}}">Harap lengkapi profil anda</a>
                                        @else
                                            <a class="btn btn-info" href="/akademi/kandidat/lihat_profil/{{$item->nama}}/{{$item->id}}">Lihat Profil</a>
                                        @endif
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
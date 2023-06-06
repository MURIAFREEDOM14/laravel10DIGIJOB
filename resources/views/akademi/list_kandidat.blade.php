@extends('layouts.akademi')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="" style="text-transform:uppercase;">Data Kandidat</b>
                <a href="/akademi/isi_kandidat_personal" class="float-right btn text-white" style="background-color: #FF9E27">Tambah Kandidat/Murid</a>
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
                                <th>Lihat Profil</th>
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
                                        <a class="btn btn-info" href="/akademi/kandidat/lihat_profil/{{$item->id_kandidat}}">Lihat</a>
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
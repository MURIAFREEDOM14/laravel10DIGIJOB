@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">List Lowongan Pekerjaan</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Negara</th>
                                <th>Jabatan</th>
                                {{-- <th>Kandidat Masuk</th> --}}
                                <th>Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lowongan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->negara}}</td>
                                    <td>{{$item->jabatan}}</td>
                                    {{-- <td>{{$ttl_msk}}</td> --}}
                                    <td>
                                        <a href="/manager/kandidat/lihat_lowongan_pelamar/{{$item->id_lowongan}}">Lihat</a>
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
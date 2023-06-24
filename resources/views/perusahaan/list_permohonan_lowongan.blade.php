@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">List Permohonan Lowongan Pekerjaan</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Tema Lowongan</th>
                                <th>Nama Kandidat</th>
                                <th>Tanggal</th>
                                <th>Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permohonan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_lowongan}}</td>
                                    <td>{{$item->nama_kandidat}}</td>
                                    <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}">Lihat</a>
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
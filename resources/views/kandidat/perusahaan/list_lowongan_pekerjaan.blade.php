@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">List Lowongan Pekerjaan</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th style="width: 1px">No.</th>
                                <th>Nama Perusahaan</th>
                                <th>Lowongan Pekerjaan</th>
                                <th>Tempat Kerja</th>
                                <th>Lihat Lowongan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lowongan as $item)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$item->nama_perusahaan}}
                                    </td>
                                    <td>{{$item->nama_lowongan}}</td>
                                    <td>{{$item->penempatan_kerja}}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="/lihat_lowongan_pekerjaan/{{$item->id_lowongan}}">Lihat Lowongan</a>
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
@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b style="text-transform:uppercase;">Jadwal Interview</b>
                <a href="/perusahaan/cari/kandidat" class="btn btn-primary float-right">Cari Kandidat</a>    
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="multi-filter-select" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pekerjaan</th>
                                <th>Tentukan Jadwal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interview as $item)
                                <tr>
                                    <td style="width: 1">{{$loop->iteration}}</td>
                                    <td>{{$item->jabatan}}</td>
                                    <td style="width: 1">
                                        <a href="/perusahaan/jadwal_interview" class="btn text-white" style="background-color:green">Tentukan jadwal</a>                                                
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <b style="text-transform:uppercase;">Terjadwal</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kandidat</th>
                                <th>Pekerjaan</th>
                                <th>Jadwal Interview</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($terjadwal as $item)
                                <tr>
                                    <td style="width: 1">{{$loop->iteration}}</td>
                                    <td style="text-transform: uppercase;">{{$item->nama_kandidat}}</td>
                                    <td style="width: 1">{{$item->jabatan}}</td>
                                    <td>{{date('d-M-Y | h:m:s',strtotime($item->jadwal_interview))}}</td>
                                    <td style="width: 1">
                                        @if ($item->kesempatan !== 1)
                                            <a class="btn btn-warning" href="/perusahaan/edit/kandidat/interview/{{$item->id_interview}}"><i class="fas fa-pencil-alt"></i></a>                                            
                                        @endif
                                            <a class="btn btn-danger" href="/perusahaan/hapus/kandidat/interview/{{$item->id_interview}}"><i class="fas fa-trash-alt"></i></a>                                            
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
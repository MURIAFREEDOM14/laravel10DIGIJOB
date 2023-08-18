@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        {{-- <div class="card">
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
        </div> --}}
        {{-- <hr> --}}
        <div class="card">
            <div class="card-header">
                <h5 style="text-transform: uppercase; font-weight:bold;">Tanggal Interview</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Nama Kandidat</h5>
                    </div>
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Tanggal Interview</h5>
                    </div>
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Urutan Kandidat</h5>
                    </div>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        @foreach ($kandidat as $nama)
                            <div class="col-3">
                                <label for="" style="text-transform:uppercase;" class="col-form-label">{{$loop->iteration}}. {{$nama->nama}}</label>
                                <input type="number" hidden name="id_kandidat[]" value="{{$nama->id_kandidat}}" id="">
                            </div>
                            <div class="col-3">
                                <select class="form-control"  name="dater[]" id="">
                                    @foreach ($jadwal as $time)
                                        <option value="{{$time}}">{{date('d M Y',strtotime($time))}}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="urutan[]" class="form-control" id="">
                                    @foreach ($kandidat as $item)
                                        <option value="{{$loop->iteration}}">{{$loop->iteration}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>    
    </div>
@endsection
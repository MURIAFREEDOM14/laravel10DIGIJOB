@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight: 600; text-transform:uppercase">Penolakan Kandidat Dari Perusahaan</h5>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Kandidat</th>
                                <th>Nama Perusahaan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penolakan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->nama_kandidat}}</td>
                                    <td>
                                        <a class="btn" href="/manager/kandidat/lihat/penolakan_kandidat/{{$item->persetujuan_id}}">Lihat</a>
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
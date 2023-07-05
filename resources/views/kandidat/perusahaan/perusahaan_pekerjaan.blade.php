@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">List Pekerjaan {{$negara->negara}}</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th style="width: 1px">No.</th>
                                <th>Nama Pekerjaan</th>
                                <th>Syarat Umur</th>
                                <th>Syarat Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pekerjaan as $item)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$item->nama_pekerjaan}}
                                    </td>
                                    <td>{{$item->syarat_umur}}</td>
                                    <td>
                                        @if ($item->syarat_kelamin == "M")
                                            Laki-laki
                                        @elseif($item->syarat_kelamin == "F")
                                            Perempuan
                                        @else
                                            Laki-laki & Perempuan
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="/detail_pekerjaan_perusahaan/{{$item->id_pekerjaan}}/{{$nama}}">Pilih Pekerjaan Ini</a>
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
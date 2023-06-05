@extends('layouts.manager')

@section('content')
    <div class="container">
        @if (auth()->user()->type == 3)
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">Data Kandidat Luar Negeri</h4>
                    <a href="/tambah_kandidat_personal" class="btn btn-primary float-right">Tambah Kandidat</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No telp</th>
                                    <th>Penempatan Negara</th>
                                    <th>Lihat Bio Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kandidat as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->penempatan }}</td>
                                    <td>
                                        <a href="/manager/kandidat/lihat_profil/{{$item->id_kandidat}}">Lihat Profil</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @elseif (auth()->user()->type == 2)
        
        @elseif (auth()->user()->type == 1)
        
        @else
            <div class="card">
                <div class="card-header">
                    Biodata Diri
                </div>
                <div class="card-body">
                    <div class="row">
                        
                    </div>
                </div>
            </div>        
        @endif
    </div>
@endsection

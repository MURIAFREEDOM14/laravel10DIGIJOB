@extends('layouts.manager')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title float-left">Data Kandidat Luar Negeri</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Pendidikan</th>
                                        <th>Penempatan Negara</th>
                                        <th>Lihat Bio Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kandidat as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->pendidikan }}</td>
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
        </div>
    </div>
@endsection
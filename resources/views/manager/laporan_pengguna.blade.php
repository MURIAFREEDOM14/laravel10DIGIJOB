@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="float-left" style="text-transform: uppercase">Laporan Pengguna</h5>
                <a class="float-right btn btn-primary" href="/manager/perbarui_laporan_pengguna">Perbarui Laporan</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 style="text-transform:uppercase">Pengguna Login</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="multi-filter-select" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Email</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwalIn as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{date('d-M-Y',strtotime($item->data_created))}}</td>
                                                {{-- <td>
                                                    <a href="/manager/lihat_profil/{{$item->id_kandidat}}">Lihat Profil</a>
                                                </td> --}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 style="text-transform: uppercase">Pengguna Baru</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Email</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwalNew as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{date('d-M-Y',strtotime($item->data_created))}}</td>
                                                {{-- <td>
                                                    <a href="/manager/lihat_profil/{{$item->id_kandidat}}">Lihat Profil</a>
                                                </td> --}}
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
        </div>
    </div>
@endsection
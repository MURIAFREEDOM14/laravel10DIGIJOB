@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight: bold" class="float-left">List Lowongan Pekerjaan</h5>
                <a class="btn btn-primary float-right" href="/perusahaan/buat_lowongan">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Jabatan</th>
                                <th>Negara Tujuan</th>
                                <th>Lihat Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lowongan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->jabatan}}</td>
                                    <td>{{$item->negara}}</td>
                                    <td>
                                        <a class="" href="/perusahaan/lihat_lowongan/{{$item->id_lowongan}}">
                                            <div class="avatar-xl">
                                                @if ($item->gambar_lowongan !== null)
                                                    <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Lowongan Pekerjaan/{{$item->gambar_lowongan}}" alt="" class="avatar-img rounded-circle img">
                                                @else
                                                    <img src="/gambar/default_user.png" alt="" class="avatar-img rounded-circle img">
                                                @endif
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="/perusahaan/edit_lowongan/{{$item->id_lowongan}}">Edit</a>
                                        <a class="btn btn-danger" href="/perusahaan/hapus_lowongan/{{$item->id_lowongan}}" onclick="hapusData(event)">Hapus</a>
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

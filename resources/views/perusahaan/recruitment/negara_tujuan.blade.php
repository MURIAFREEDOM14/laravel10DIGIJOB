@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Penempatan Negara Kerja</b>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                    Tambah Negara Kerja
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="/perusahaan/tambah/negara" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Negara</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Pilih Negara</label>
                                        <select name="negara_id" required class="form-control" id="">
                                            <option value="">-- Pilih Negara --</option>
                                            @foreach ($negara as $item)
                                                <option value="{{$item->negara_id}}">{{$item->negara}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Negara Tujuan</th>
                                <th>Mata Uang Negara</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($negara_perusahaan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_negara}}</td>
                                    <td>{{$item->mata_uang}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="/perusahaan/pekerjaan/{{$item->negara_id}}/{{$item->nama_negara}}">Lihat Pekerjaan</a>
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
@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Pelatihan</h5>
                <a href="/manager/kandidat/tambah_pelatihan" class="float-right btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($pelatihan as $item)
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>{{$item->judul}}</b>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <video width="200" poster="/gambar/Manager/Pelatihan/{{$item->judul}}/Thumbnail/{{$item->thumbnail}}" controls>
                                                <source src="/gambar/Manager/Pelatihan/{{$item->judul}}/Video/{{$item->video}}" type="video/mp4">
                                            </video>
                                        </div>
                                        <div class="col-6">
                                            <b>{{$item->deskripsi}}</b>
                                        </div>
                                        <a class="btn btn-warning" href="/manager/kandidat/edit_pelatihan/{{$item->id}}">Edit</a>
                                        <a class="btn btn-danger ml-1" href="/manager/kandidat/hapus_pelatihan/{{$item->id}}">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
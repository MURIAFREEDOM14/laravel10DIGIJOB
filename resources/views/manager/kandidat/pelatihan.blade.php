@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left" style="font-weight: 700">Video Pelatihan</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">+ Tambah Tema</button>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($pelatihan as $item)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <b class="float-left">{{$item->tema_pelatihan}}</b>
                                    <a class="btn btn-danger float-right" href="/manager/kandidat/hapus_tema_pelatihan/{{$item->tema_pelatihan_id}}">Hapus</a>
                                    <a class="btn btn-warning float-right mx-1" href="/manager/kandidat/edit_tema_pelatihan/{{$item->tema_pelatihan_id}}">edit</a>
                                    <a class="btn btn-primary float-right" href="/manager/kandidat/lihat_video_pelatihan/{{$item->tema_pelatihan_id}}">Lihat</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="/manager/kandidat/tambah_tema_pelatihan" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tema Pelatihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nama Tema</label>
                    <input type="text" class="form-control" name="tema" required id="recipient-name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
          </div>
        </div>
    </div>
@endsection
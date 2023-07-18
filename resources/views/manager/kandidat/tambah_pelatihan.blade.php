@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Pelatihan</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Masukkan Judul</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="judul" required id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Masukkan Video</label>
                        </div>
                        <div class="col-8">
                            <input type="file" class="form-control" name="video" required id="" accept="video/*">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Masukkan URL</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" placeholder="Masukkan url video jika ada" name="url" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Sertakan Thumbnail</label>
                        </div>
                        <div class="col-8">
                            <input type="file" class="form-control" name="thumbnail" id="" accept="image/*">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">TambahKan Deskripsi</label>
                        </div>
                        <div class="col-8">
                            <textarea name="deskripsi" id="" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Pilih Negara</label>
                        </div>
                        <div class="col-8">
                            <select name="negara_id" class="form-control" required id="">
                                <option value="">-- Pilih Negara --</option>
                                @foreach ($negara as $item)
                                    <option value="{{$item->negara_id}}">{{$item->negara}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <a class="btn btn-danger" href="/manager/kandidat/lihat_video_pelatihan/{{$pelatihan->tema_pelatihan_id}}">Kembali</a>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
        </div>
    </div>
@endsection
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
                            <input type="text" value="{{$pelatihan->judul}}" class="form-control" name="judul" required id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Masukkan Video</label>
                        </div>
                        <div class="col-8">
                            @if ($pelatihan->video == "")
                                <input type="file" name="video" id="inputPassword6" class="form-control @error('video') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">                                        
                            @elseif ($pelatihan->video !== null)
                                <video width="400" controls>
                                    <source src="/gambar/Manager/Pelatihan/{{$pelatihan->judul}}/Video/{{$pelatihan->video}}" type="video/mp4">
                                </video>
                                <input type="file" name="video" id="inputPassword6" class="form-control @error('video') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">
                            @else
                                <input type="file" name="video" id="inputPassword6" class="form-control @error('video') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">                                        
                            @endif
                            @error('video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Masukkan URL</label>
                        </div>
                        <div class="col-8">
                            <input type="text" value="{{$pelatihan->url}}" class="form-control" placeholder="Masukkan url video jika ada" name="url" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Sertakan Thumbnail</label>
                        </div>
                        <div class="col-8">
                            @if ($pelatihan->thumbnail == "")
                                <input type="file" name="thumbnail" id="inputPassword6" class="form-control @error('thumbnail') is_invalid @enderror" accept="image/*">                                        
                            @elseif ($pelatihan->thumbnail !== null)
                                <img src="/gambar/Manager/Pelatihan/{{$pelatihan->judul}}/Thumbnail/{{$pelatihan->thumbnail}}" width="150px" height="150px" alt="">
                                <input type="file" name="thumbnail" id="inputPassword6" class="form-control @error('thumbnail') is_invalid @enderror" accept="image/*">                                        
                            @else
                                <input type="file" name="thumbnail" id="inputPassword6" class="form-control @error('thumbnail') is_invalid @enderror" accept="image/*">                                        
                            @endif
                            @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">TambahKan Deskripsi</label>
                        </div>
                        <div class="col-8">
                            <textarea name="deskripsi" id="" class="form-control">{{$pelatihan->deskripsi}}</textarea>
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
                                    <option value="{{$item->negara_id}}" @if ($pelatihan->negara_id == $item->negara_id)
                                        selected
                                    @endif>{{$item->negara}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <a class="btn btn-danger" href="/manager/kandidat/lihat_video_pelatihan/{{$pelatihan->tema_pelatihan_id}}">Kembali</a>
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection
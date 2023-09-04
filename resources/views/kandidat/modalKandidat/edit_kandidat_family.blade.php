@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">        
    <div class="">
        <div class="">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <form action="/isi_kandidat_family" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="" id="family_background">
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <h6 class="ms-5">Data Berkeluarga</h6> 
                            </div>
                        </div>
                        @if ($kandidat->stats_nikah == "Cerai hidup")
                            <div class="" id="punya_anak">
                                {{-- <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Apakah Anda Sudah Memiliki Anak?</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="" id="anak" class="form-select">
                                            <option value="tidak" @if ($kandidat->jml_anak_lk == null && $kandidat->jml_anak_pr == null)
                                                selected
                                            @endif>Tidak</option>
                                            <option value="ya" @if ($kandidat->jml_anak_lk !== null || $kandidat->jml_anak_pr !== null)
                                                selected
                                            @endif>Ya</option>
                                        </select>
                                    </div>
                                </div> --}}
                                @if ($keluarga)
                                {{-- @if ($keluarga->count() > 0) --}}
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Usia Anak</label>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                @foreach ($keluarga as $item)
                                                    <li class="list-group-item">Anak Ke {{$item->anak_ke}} | Usia {{$item->usia}} Tahun | 
                                                        @if ($item->jenis_kelamin == "M")
                                                            Laki-laki 
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </li>
                                                    <div class="" hidden>
                                                        <input type="number" name="id_anak[]" value="{{$item->id_keluarga}}" id="">
                                                        <input type="date" name="tgl_anak[]" value="{{$item->tgl_lahir_anak}}" id="">    
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#data_anak">Tambah Data</button>
                                        </div>
                                    </div>    
                                @endif
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Surat Keterangan Cerai</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_cerai !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Cerai/{{$kandidat->foto_cerai}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" class="form-control" name="foto_cerai" accept="image/*">                                        
                                    @else
                                        <input type="file" required class="form-control" name="foto_cerai" accept="image/*">
                                    @endif
                                </div>
                            </div>
                        @elseif ($kandidat->stats_nikah == "Cerai mati") 
                            <div class="" id="punya_anak">
                                {{-- <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Apakah Anda Sudah Memiliki Anak?</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="" id="anak" class="form-select">
                                            <option value="tidak" @if ($kandidat->jml_anak_lk == null && $kandidat->jml_anak_pr == null)
                                                selected
                                            @endif>Tidak</option>
                                            <option value="ya" @if ($kandidat->jml_anak_lk !== null || $kandidat->jml_anak_pr !== null)
                                                selected
                                            @endif>Ya</option>
                                        </select>
                                    </div>
                                </div> --}}
                                @if ($keluarga->count() > 0)
                                {{-- @if ($keluarga->count() > 0) --}}
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Usia Anak</label>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                @foreach ($keluarga as $item)
                                                    <li class="list-group-item">Anak Ke {{$item->anak_ke}} | Usia {{$item->usia}} Tahun | 
                                                        @if ($item->jenis_kelamin == "M")
                                                            Laki-laki 
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </li>
                                                    <div class="" hidden>
                                                        <input type="number" name="id_anak[]" value="{{$item->id_keluarga}}" id="">
                                                        <input type="date" name="tgl_anak[]" value="{{$item->tgl_lahir_anak}}" id="">    
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#data_anak">Tambah Data</button>
                                        </div>
                                    </div>    
                                @endif
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Akta Kematian Pasangan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_kematian_pasangan !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Kematian Pasangan/{{$kandidat->foto_kematian_pasangan}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" class="form-control" name="foto_kematian_pasangan" accept="image/*">
                                    @else
                                        <input type="file" required class="form-control" name="foto_kematian_pasangan" accept="image/*">
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Buku Nikah</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_buku_nikah !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Buku Nikah/{{$kandidat->foto_buku_nikah}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                                    @else
                                        <input type="file" required name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Pasangan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_pasangan}}" name="nama_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tanggal Lahir Pasangan</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" required class="form-control" name="tgl_lahir_pasangan" value="{{$kandidat->tgl_lahir_pasangan}}" id="">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Pekerjaan Pasangan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->pekerjaan_pasangan}}" name="pekerjaan_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="" id="punya_anak">
                                {{-- <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Apakah Anda Sudah Memiliki Anak?</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="" id="anak" class="form-select">
                                            <option value="tidak" @if ($kandidat->jml_anak_lk == null && $kandidat->jml_anak_pr == null)
                                                selected
                                            @endif>Tidak</option>
                                            <option value="ya" @if ($kandidat->jml_anak_lk !== null || $kandidat->jml_anak_pr !== null)
                                                selected
                                            @endif>Ya</option>
                                        </select>
                                    </div>
                                </div> --}}
                                @if ($keluarga)
                                {{-- @if ($keluarga->count() > 0) --}}
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Usia Anak</label>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                @foreach ($keluarga as $item)
                                                    <li class="list-group-item">Anak Ke {{$item->anak_ke}} | Usia {{$item->usia}} Tahun | 
                                                        @if ($item->jenis_kelamin == "M")
                                                            Laki-laki 
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </li>
                                                    <div class="" hidden>
                                                        <input type="number" name="id_anak[]" value="{{$item->id_keluarga}}" id="">
                                                        <input type="date" name="tgl_anak[]" value="{{$item->tgl_lahir_anak}}" id="">    
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#data_anak">Tambah Data</button>
                                        </div>
                                    </div>    
                                @endif
                            </div>
                        @endif
                    </div>
                    <hr>
                    {{-- <a class="btn btn-warning" href="{{route('vaksin')}}">Lewati</a> --}}
                    <button class="btn btn-primary float-end" type="submit">Selanjutnya</button>
                </form>
            </div>
            <hr>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="data_anak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/isi_kandidat_anak" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="" class="">Anak Ke</label>
                        <input type="number" name="anak_ke" required class="form-control" id="">
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="">Jenis Kelamin</label>
                        <select name="jk" class="form-select" id="" required>
                            <option value="">-- Jenis Kelamin Anak --</option>
                            <option value="M">Laki-laki</option>
                            <option value="F">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="">Tanggal Lahir Anak</label>
                        <input type="date" required name="tgl_lahir_anak" id="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
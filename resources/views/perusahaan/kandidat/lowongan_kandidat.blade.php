@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="" class="">Nama Lowongan</label>
                    <div class="input-group">
                        <label for=""></label>
                        <select name="id_lowongan" id="" required class="form-control">
                            <option value="">-- Nama Lowongan --</option>
                            @foreach ($semua_lowongan as $item)
                                <option value="{{$item->id_lowongan}}" @if ($item->id_lowongan == $id)
                                    selected
                                @endif>{{$item->jabatan}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-secondary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="float-left"><b class="bold">Kandidat Dalam Perusahaan Anda</b></h4>
        </div>
        <div class="card-body">
            <form action="/perusahaan/pilih/kandidat" method="POST">
                @csrf
                <div class="row">
                    @if ($isi == 0)
                        <div class="col-md-12 text-center">
                            <b>Maaf perusahaan anda masih belum punya kandidat</b>
                        </div>
                    @else
                        @foreach ($kandidat as $item)
                            <div class="col-md-3">
                                <div class="card" style="width: 100%; height:auto">
                                    <a class="btn" style="border: 2px solid #1269DB; border-top-left-radius:10%;border-bottom-right-radius:10%" href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}">
                                        <div class="card-header text-center mt--5">
                                            <div class="avatar avatar-xl">
                                                @if ($item->foto_4x6 == null)
                                                    <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
                                                @else
                                                    <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="" class="avatar-img rounded-circle">                                            
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center" style="background-color: #1269DB; padding-bottom:3px; ">
                                            <div class="mt-2" style="color: white; text-transform:uppercase;">
                                                {{$item->nama_panggilan}}
                                                <input hidden type="text" name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </form>
            <hr>
            <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-danger">Kembali</a>
            <div class="modal fade" id="cari_kandidat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Cari Kandidat</h5>
                        </div>
                        <form action="/perusahaan/cari/kandidat" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="">Usia</div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" required name="usia" value="{{18}}" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="">Syarat Kelamin</div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-check">
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="jenis_kelamin" value="M" checked="">
                                                <span class="form-radio-sign">Laki-laki</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="jenis_kelamin" value="F">
                                                <span class="form-radio-sign">Perempuan</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="jenis_kelamin" value="MF">
                                                <span class="form-radio-sign">Laki-laki & Perempuan</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="">Pendidikan</div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-check">
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="pendidikan" checked="" value="Tidak_sekolah,SD,SMP">
                                                <span class="form-radio-sign">< SMP</span>
                                            </label>
                                            <label class="form-radio-label ml-2">
                                                <input class="form-radio-input" type="radio" name="pendidikan" value="SMA">
                                                <span class="form-radio-sign">SMA</span>
                                            </label>
                                            <label class="form-radio-label ml-2">
                                                <input class="form-radio-input" type="radio" name="pendidikan" value="Diploma">
                                                <span class="form-radio-sign">Diploma</span>
                                            </label>
                                            <label class="form-radio-label ml-2">
                                                <input class="form-radio-input" type="radio" name="pendidikan" value="Sarjana">
                                                <span class="form-radio-sign">Sarjana</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="">Tinggi / Berat</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" name="tinggi" class="form-control" placeholder="Tinggi" aria-label="Tinggi" aria-describedby="basic-addon1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Cm</span>
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="number" name="berat" class="form-control" placeholder="Berat" aria-label="Berat" aria-describedby="basic-addon1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="">Domisili Pekerja</div>
                                    </div>
                                    <div class="col-md-8">
                                        @livewire('pencarian')
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="">Pengalaman</div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-check">
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="lama_kerja" checked="" value="">
                                                <span class="form-radio-sign">Fresh Graduate</span>
                                            </label>
                                            <label class="form-radio-label ml-2">
                                                <input class="form-radio-input" type="radio" name="lama_kerja" value="1,2,3,4">
                                                <span class="form-radio-sign">1 - 4thn</span>
                                            </label>
                                            <label class="form-radio-label ml-2">
                                                <input class="form-radio-input" type="radio" name="lama_kerja" value="5">
                                                <span class="form-radio-sign">5thn++</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
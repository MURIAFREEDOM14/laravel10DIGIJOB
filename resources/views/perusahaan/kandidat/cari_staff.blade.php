@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Kriteria Pencarian Staff</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="">Usia Minimum</div>
                        </div>
                        <div class="col-md-2">
                            <input type="number" value="{{18}}" required name="usia" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="">Syarat Kelamin</div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="jenis_kelamin" checked="" value="M">
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
                            <div class="">Pendidikan Terakhir</div>
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
                            <div class="">Tinggi / Berat Badan</div>
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
                    {{-- <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="">Jumlah Kebutuhan Staff</div>
                        </div>
                        <div class="col-md-2">
                            <input type="number" required name="jml_kebutuhan" class="form-control" id="">
                        </div>
                    </div> --}}
                    <button class="btn btn-primary float-right" type="submit">Cari</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <b class="bold">Pencarian Staff</b>
            </div>
            <div class="card-body">
                <form action="/perusahaan/pilih/kandidat" method="POST">
                    @csrf
                    @if ($isi !== 0 && $isi !== "")
                        <div class="row mb-2">
                            <div class="">
                                <button class="btn btn-success" type="submit">Pilih</button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @if ($isi == "")
                        @elseif($isi == 0)
                            <div class="col-md-12 text-center">
                                <b>Maaf Staff yang anda minta masih belum tersedia</b>
                                <p>Sedang dalam pencarian</p>
                            </div>
                        @else
                            @foreach ($kandidat as $item)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" name="id_kandidat[]" value="{{$item->id_kandidat}}">
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <b class="float-left">{{$item->nama_panggilan}}</b>
                                            <b class="float-right">{{$item->usia}}thn</b>
                                        </div>
                                        <div class="card-body">
                                            <div class="avatar-sm float-left">
                                                @if ($item->foto_4x6 == null)
                                                    <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
                                                @else
                                                    <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="" class="avatar-img rounded-circle">                                            
                                                @endif
                                            </div>
                                            <div class="float-right">
                                                <a href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}" class="btn btn-primary">
                                                    lihat profil
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
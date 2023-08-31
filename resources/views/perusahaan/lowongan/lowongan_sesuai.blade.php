@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <b class="bold">Kandidat Yang Sesuai</b>
            {{-- <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#cari_kandidat">
                <i class="fas fa-search"></i> Apa yang anda butuhkan?
            </button>     --}}
        </div>
        <div class="card-body">
            <form action="/perusahaan/terima_permohonan_lowongan/{{$id}}" method="POST">
                @csrf
                {{-- <div class="row mb-2">
                    <div class="">
                        <button class="btn btn-success" type="submit">Select</button>
                    </div>    
                </div> --}}
                <div class="row">
                    {{-- @if ($isi == 0)
                    <div class="col-md-12 text-center">
                        <b>Maaf kandidat yang anda minta masih belum tersedia</b>
                        <p>Sedang dalam pencarian</p>
                    </div>
                    @else --}}
                        @foreach ($kandidat as $item)
                            @if ($item->jenis_kelamin == $lowongan->jenis_kelamin || $lowongan->jenis_kelamin == "MF")
                                @if ($item->kabupaten == $lowongan->pencarian_tmp || $item->provinsi == $lowongan->pencarian_tmp || $lowongan->pencarian_tmp == "Se-indonesia")
                                    <div class="col-md-3">
                                        <input type="checkbox" name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                                        <div class="card">
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
                                                <div class="text-center" style="background-color: #1269DB">
                                                    <div class="mt-2" style="color: white; text-transform:uppercase">
                                                        {{$item->nama_panggilan}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif                                    
                            @endif
                        @endforeach
                    {{-- @endif --}}
                </div>
                <hr>
                <button class="float-right btn btn-success">Pilih Kandidat</button>
                <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-danger float-left">Kembali</a>    
            </form>
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
                                        <input type="number" required value="{{18}}" name="usia" class="form-control" id="">
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
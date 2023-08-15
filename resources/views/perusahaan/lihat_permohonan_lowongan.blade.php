@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
@php
    $jml_interview = $interview->count();
@endphp
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">List Pelamar Lowongan Pekerjaan</b></h4>
            </div>
            <div class="card-body">
                <form action="/perusahaan/terima_permohonan_lowongan/{{$id}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <button class="btn btn-success" type="submit">Pilih</button>
                    </div>    
                    <div class="row">
                        @if ($isi == 0)
                            <div class="col-md-12 text-center">
                                <b>Maaf, belum ada kandidat yang menerima lowongan</b>
                            </div>
                        @else
                            @foreach ($permohonan as $item)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" name="id_kandidat[]" value="{{$item->id_kandidat}}">
                                                <input type="text" hidden name="id_lowongan" id="" value="{{$id}}">
                                            </div>
                                        </div>                        
                                        <div class="card-header">
                                            <b class="float-left">{{$item->nama_panggilan}}</b>
                                            <b class="float-right">{{$item->usia}}thn</b>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="avatar-sm float-left">
                                                @if ($item->foto_4x6 == null)
                                                    <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
                                                @else
                                                    <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
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
                {{-- <div class="row">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cari_kandidat">
                        <i class="fas fa-search"></i> Apa yang anda butuhkan?
                    </button>
                </div>
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
                                        <div class="col-md-8">
                                            <input type="number" name="usia" required class="form-control" value="{{18}}" id="">
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
                </div> --}}
                {{-- <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Jabatan</th>
                                <th>Nama Kandidat</th>
                                <th>Negara</th>
                                <th>Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permohonan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->jabatan}}</td>
                                    <td>{{$item->nama_kandidat}}</td>
                                    <td>{{$item->negara}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}">Lihat</a>
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </div>
        </div>
        @if ($jml_interview !== 0)
            <div class="card">
                <div class="card-header">
                    <h4><b class="bold">Kandidat Dipilih</b></h4>
                </div>
                <div class="card-body">
                    <form action="/perusahaan/batal_permohonan_lowongan/{{$id}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <button type="submit" class="btn btn-danger">Batal Pilih</button>
                        </div>
                        <div class="row">
                            @foreach ($interview as $item)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" name="id_kandidat[]" value="{{$item->id_kandidat}}">
                                                <input type="text" hidden name="id_lowongan" id="" value="{{$id}}">
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
                                                    <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
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
                        </div>
                    </form>
                </div>
            </div>    
        @endif
    </div>
@endsection
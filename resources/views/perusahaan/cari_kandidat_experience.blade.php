@extends('layouts.perusahaan')
@section('content')
<div class="container mt-5">
    <h3 style="text-transform: uppercase">Cari Kandidat</h3>
    <hr>
    <div class="card">
        <div class="card-header mx-auto">
            <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="pills-home-tab-nobd" href="/perusahaan/cari_kandidat" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Baru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="pills-profile-tab-nobd" href="/perusahaan/cari_kandidat/experience" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Berpengalaman</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    Kriteria Kandidat
                </div>
                <div class="card-body">
                    <form action="/perusahaan/cari_kandidat/experience" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="">Jenis Kelamin</label>
                            </div>
                            <div class="col-8">
                                <select name="jenis_kelamin" class="form-control" required id="">
                                    <option value="">-- Pilih Jenis Kelamin Kandidat --</option>
                                    <option value="M" @if ($jk == "M")
                                        selected
                                    @endif>Laki-laki</option>
                                    <option value="F" @if ($jk == "F")
                                        selected
                                    @endif>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="">Usia</label>
                            </div>
                            <div class="col-8">
                                <input type="number" name="usia" value="{{$usia}}" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="">Pengalaman Kerja</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="pengalaman_kerja" value="{{$pengalaman_kerja}}" class="form-control" id="">
                            </div>
                        </div>
                        <div class="float-left">
                            <a href="/perusahaan" class="btn btn-danger"><i class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                            <button type="submit" class="btn ml-2" style="background-color: #FFD95A"><i class="fas fa-search"></i> Cari</button>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            List Kandidat
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($kandidat as $item)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-left">{{$item->nama}}</div>
                                <div class="float-right">{{$item->usia}}thn</div>
                            </div>
                            <div class="card-body">
                                <div class="avatar-sm float-left">
                                    @if ($item->foto_4x6 == null)
                                        <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                        
                                    @else
                                        <img src="/gambar/Kandidat/4x6/{{$item->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                        
                                    @endif
                                </div>
                                <a href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}" class="btn btn-primary float-right">Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
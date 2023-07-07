@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Kriteria Pencarian Staff / Karyawan</b>
            </div>
            <div class="card-body">
                <a class="btn btn-outline-primary" data-toggle="collapse" href="#kriteria" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Lihat Kriteria
                </a>
                <hr>
                <div class="collapse mt-3" id="kriteria">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="">Bekerja Dalam Bidang</label>
                        </div>
                        <div class="col-8">
                            <b class="bold">: {{$permohonan->pekerjaan}}</b>
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="">Usia</label>
                        </div>
                        <div class="col-8">
                            <b class="bold">: {{$permohonan->usia}}</b>
                        <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="">Syarat Kelamin</label>
                        </div>
                        <div class="col-8">
                            <b class="bold">: 
                                @if ($permohonan->syarat_kelamin == "M")
                                Laki-laki
                                @elseif($permohonan->syarat_kelamin == "F")    
                                Perempuan
                                @else
                                Laki-laki & Perempuan
                                @endif
                            </b>
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="">Pendidikan</label>
                        </div>
                        <div class="col-8">
                            <b class="bold">: {{$permohonan->pendidikan}}</b>
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="">Tinggi / Berat</label>
                        </div>
                        <div class="col-4">
                            <b class="bold">: 
                                @if ($permohonan->tinggi !== null)
                                    {{$permohonan->tinggi}}
                                @else    
                                    Tidak ada batasan
                                @endif 
                            </b>
                            <hr>
                        </div>
                        <div class="col-4">
                            <b class="bold">: 
                                @if ($permohonan->berat)
                                    {{$permohonan->berat}}
                                @else
                                    Tidak ada batasan
                                @endif
                            </b>
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="">Domisili</label>
                        </div>
                        <div class="col-8">
                            <b class="bold">: {{$permohonan->domisili}}</b>
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="">Lama Pengalaman Kerja</label>
                        </div>
                        <div class="col-8">
                            <b class="bold">: {{$permohonan->lama_pengalaman}}</b>
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="">Jumlah Kebutuhan Kandidat</label>
                        </div>
                        <div class="col-8">
                            <b class="bold">: {{$permohonan->jml_kebutuhan}}</b>
                            <hr>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <b class="bold">Kirim Staff</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        @foreach ($staff as $item)
                            <div class="col-4">
                                <div class="card">
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
                                            <a href="/manager/kandidat/lihat_profil/{{$item->id_kandidat}}" class="btn btn-primary">
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
    </div>
@endsection
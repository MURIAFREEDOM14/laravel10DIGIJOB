@extends('layouts.perusahaan')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Seleksi Kandidat</b>
            </div>
            <div class="card-body">
                <!-- form(post) PerusahaanRecruitmentController => terimaSeleksiKandidat -->
                <form action="" method="POST">
                    @csrf
                    <!-- apabila data kandidat kosong -->
                    @if ($kandidat->count() == 0)
                        <h5 class="text-center" style="text-transform: uppercase;font-weight:600;">Maaf belum ada kandidat yang menyetujui undangan interview</h5>
                    @else
                        <!-- menampilkan data kandidat -->
                        @foreach ($kandidat as $item)
                            <div class="row" style="border-top: 0.1px solid #dfdfdf; padding: 10px; border-bottom:0.1px solid #dfdfdf">
                                <div class="col-md-1">
                                    <!-- mengambil data id kandidat -->
                                    <input type="checkbox" name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                                </div>
                                <div class="col-md-7">
                                    <label for="" style="font-weight: 600; text-transform:uppercase;" class="">{{$item->nama}}</label>
                                </div>
                                <div class="col-md-4">
                                    <label for="" style="font-weight: 600; text-transform:uppercase;">| {{$item->usia}} Tahun | 
                                        @if ($item->jenis_kelamin == "M")
                                            Laki-laki
                                        @else 
                                            Perempuan   
                                        @endif|
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <hr>
                    <!-- apabila data kandidat ada / tidak kosong -->
                    @if ($kandidat->count() !== 0)
                        <button class="btn btn-outline-success float-right" type="submit">Terima Kandidat</button>
                        <a class="btn btn-outline-danger float-right mx-1" href="/perusahaan/tolak_seleksi_kandidat/{{$id}}" onclick="tolakData(event)">Tolak semua</a>                        
                    @endif
                    <a class="btn btn-danger" href="/perusahaan/lihat_jadwal_interview/{{$id}}">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
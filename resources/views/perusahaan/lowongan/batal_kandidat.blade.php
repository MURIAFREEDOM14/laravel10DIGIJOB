@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left"><b class="bold">Batal Pilih Kandidat</b></h4>
            </div>
            <div class="card-body">                
                <!-- form(post) PerusahaanRecruitmentController => confirmCancelKandidatLowongan -->
                <form action="" method="POST">
                    @csrf
                    <div class="row">        
                        <!-- menampilkan data kandidat yang sudah dipilih / stat_pemilik = kosong -->
                        @foreach ($kandidat as $item)
                            <div class="col-3">
                                <!-- mengambil banyaknya data kadidat yang dibatalkan dengan id kandidat -->
                                <input type="checkbox" name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                                <div class="card">
                                    <a class="btn" style="border: 2px solid #1269DB; border-top-left-radius:10%;border-bottom-right-radius:10%" href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}">
                                        <div class="card-header text-center mt--5">
                                            <div class="avatar avatar-xxl" style="width: auto; height:auto;">
                                                @if ($item->foto_4x6 == null)
                                                    <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
                                                @else
                                                    <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="" class="avatar-img rounded-circle">                                            
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body text-center" style="background-color: #1269DB">
                                            <div class="mt-2" style="color: white; text-transform:uppercase">
                                                {{$item->nama_panggilan}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <button class="btn btn-danger float-right" type="submit" id="">Batalkan kandidat</button>
                    <a class="btn btn-danger" href="/perusahaan/list_permohonan_lowongan">Kembali</a>    
                </form>
            </div>
        </div>
    </div>
@endsection
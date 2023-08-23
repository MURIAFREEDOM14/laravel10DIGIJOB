@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left"><b class="bold">Kandidat Dipilih</b></h4>
            </div>
            <div class="card-body">                
                <form action="/perusahaan/kandidat_dipilih_interview/{{$id}}" method="POST">
                    @csrf
                    <div class="row">        
                        @foreach ($kandidat as $item)
                            <div class="col-3">
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
                                        <div class="card-body text-center" style="background-color: #1269DB">
                                            <div class="mt-2" style="color: white; text-transform:uppercase">
                                                {{$item->nama_panggilan}}
                                                <input hidden type="text" name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    @if ($isi !== 0)
                        @if ($interview == null)
                            <button class="btn btn-success float-right" type="submit" id="">Konfirmasi kandidat</button>    
                            <a class="btn btn-danger float-right mx-1" href="/perusahaan/batal_kandidat_lowongan/{{$id}}">Batalkan kandidat</a>                            
                        @else
                            <a class="btn btn-warning float-right" href="/perusahaan/lihat_jadwal_interview/{{$id}}">Lihat Jadwal Interview</a>
                        @endif
                    @endif
                    <a class="btn btn-danger" href="/perusahaan/list_permohonan_lowongan">Kembali</a>    
                </form>
            </div>
        </div>
    </div>
@endsection
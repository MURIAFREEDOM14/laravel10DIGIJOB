@extends('layouts.manager')

@section('content')
    <div class="container mt-5">        
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <h4 class="mx-auto">PERSONAL BIO DATA</h4>
                </div>
                <div class="">
                    <h6 class="text-center mb-5">Indonesia</h6>
                    <!-- form(post) ManagerKandidatController => simpan_family -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="family_background">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">Data Berkeluarga</h6> 
                                </div>
                            </div>
                            <!-- apabila stats nikah = Menikah -->
                            @if ($kandidat->stats_nikah == "Menikah")
                                <!-- input foto buku nikah -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Foto Buku Nikah</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->foto_buku_nikah !== null)
                                            <img src="/gambar/Kandidat/Buku Nikah/{{$kandidat->foto_buku_nikah}}" alt="">
                                        @else
                                            <input type="file" name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        @endif
                                    </div>
                                </div>
                                <!-- input nama pasangan -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Nama Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" value="{{$kandidat->nama_pasangan}}" name="nama_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <!-- input umur pasangan -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Umur Pasangan</label>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($kandidat->umur_pasangan !== null)
                                            <input type="number" value="{{$kandidat->umur_pasangan}}" name="umur_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        @else
                                            <input type="number" value="{{0}}" name="umur_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        @endif
                                    </div>
                                </div>
                                <!-- input pekerjaan pasangan -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Pekerjaan Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" value="{{$kandidat->pekerjaan_pasangan}}" name="pekerjaan_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <div class="" id="punya_anak">
                                    
                                </div>
                            <!-- apabila stats nikah = cerai hidup -->
                            @elseif ($kandidat->stats_nikah == "Cerai hidup")
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Surat Keterangan Cerai</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->foto_cerai)
                                            <img src="/gambar/Kandidat/Cerai/{{$kandidat->foto_cerai}}" alt="">
                                        @else
                                            <input type="file" class="form-control" name="foto_cerai" accept="image/*">
                                        @endif
                                    </div>
                                </div>
                            <!-- apabila stats nikah = cerai mati -->
                            @elseif ($kandidat->stats_nikah == "Cerai mati") 
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Akta Kematian Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->foto_cerai)
                                            <img src="/gambar/Kandidat/Kematian Pasangan/{{$kandidat->foto_kematian_pasangan}}" alt="">
                                        @else
                                            <input type="file" class="form-control" name="foto_kematian_pasangan" accept="image/*">
                                        @endif
                                    </div>
                                </div>                            
                            @endif
                        </div>
                        <hr>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
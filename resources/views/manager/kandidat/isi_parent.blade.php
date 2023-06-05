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
                    <form action="" method="POST">
                        @csrf
                        <div class="" id="parent">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">Data Orang Tua / Wali</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Ayah</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_ayah}}" name="nama_ayah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Umur Ayah</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="{{$kandidat->umur_ayah}}" name="umur_ayah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Ibu</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_ibu}}" name="nama_ibu" class="form-control" id="">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Umur Ibu</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="{{$kandidat->umur_ayah}}" name="umur_ibu" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jumlah Saudara Laki-laki</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jumlah Saudara Perempuan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Anak Ke</label>
                                </div>
                                <div class="col-md-2">
                                    @if ($kandidat->anak_ke == null)
                                        <input type="number" value="{{1}}" class="form-control" name="anak_ke" required>
                                    @else
                                        <input type="number" value="{{$kandidat->anak_ke}}" name="anak_ke" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">                                        
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Apakah Anda Pernah memiliki Pengalaman Kerja?</label>
                                </div>
                                <div class="col-md-2">
                                    <select name="confirm" class="form-control" id="">
                                        <option value="0">Tidak</option>
                                        <option value="1" @if ($kandidat->nama_perusahaan1 !== null)
                                            selected
                                        @endif>Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
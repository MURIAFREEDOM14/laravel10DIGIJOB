@extends('layouts.perusahaan')
@section('content')
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
                            <div class="">Usia</div>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="usia" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="">Syarat Kelamin</div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="jenis_kelamin" value="M">
                                    <span class="form-radio-sign">Laki-laki</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="jenis_kelamin" value="F">
                                    <span class="form-radio-sign">Perempuan</span>
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
                                    <input class="form-radio-input" type="radio" name="pendidikan" value="Tidak_sekolah,SD,SMP">
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
                            {{-- <div class="form-check">
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="domisili">
                                    <span class="form-radio-sign">satu kota / Kabupaten</span>
                                    <input type="text" name="kabupaten" id="">
                                </label>
                                <label class="form-radio-label ml-2">
                                    <input class="form-radio-input" type="radio" name="domisili">
                                    <span class="form-radio-sign">satu Provinsi</span>
                                    <input type="text" name="provinsi" id="">
                                </label>
                                <label class="form-radio-label ml-2">
                                    <input class="form-radio-input" type="radio" name="domisili" value="">
                                    <span class="form-radio-sign">Seluruh indonesia</span>
                                </label>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="">Pengalaman</div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="pengalaman" value="baru">
                                    <span class="form-radio-sign">Fresh Graduate</span>
                                </label>
                                <label class="form-radio-label ml-2">
                                    <input class="form-radio-input" type="radio" name="pengalaman" value="1-4">
                                    <span class="form-radio-sign">1 - 4thn</span>
                                </label>
                                <label class="form-radio-label ml-2">
                                    <input class="form-radio-input" type="radio" name="pengalaman" value="5">
                                    <span class="form-radio-sign">5thn++</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="">Jumlah Kebutuhan Staff</div>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="jml_kebutuhan" class="form-control" id="">
                        </div>
                    </div>
                    <button class="btn btn-primary float-right" type="submit">Kirim Pencarian</button>
                </form>
            </div>
        </div>
    </div>
@endsection
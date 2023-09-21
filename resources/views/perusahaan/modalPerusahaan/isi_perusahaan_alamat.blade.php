@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<style>
    #dalam_n{
        display: none;
    }
    #luar_n{
        display: none;
    }
</style>
    <div class="container mt-5">
        <div class="mb-4">
            <div class="">
                <div class="row">
                    <h4 class="text-center">PERUSAHAAN BIO DATA</h4>
                    <!-- form(post) PerusahaanController => simpan_perusahaan_alamat -->
                    <form action="/perusahaan/isi_perusahaan_alamat" method="POST">
                        @csrf
                        <!-- input alamat perusahaan -->
                        <div class="row mb-3">
                            <label for="">Alamat Perusahaan</label>
                        </div>
                        <!-- mengambil data alamat perusahaan -->
                        <input type="text" hidden name="" value="{{$perusahaan->tmp_perusahaan}}" id="penempatan">
                        <!-- apabila tempat perusahaan ada dalam negeri -->
                        @if ($perusahaan->tmp_perusahaan == "Dalam negeri")
                            <!-- menggunakan livewire -->
                            <!-- lokasi livewire : app/Http/Livewire/ -->
                            @livewire('perusahaan.company-location')                                                
                        @else
                            <!-- pilihan alamat negara perusahaan -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="">Pilih Nama Negara</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="negara_id" class="form-control" required id="negara">
                                        <option value="">-- Pilih Negara --</option>
                                        <!-- menampilkan data negara -->
                                        @foreach ($negara as $item)
                                            <option value="{{$item->negara_id}}">{{$item->negara}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- input alamat negara -->    
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="">Masukkan alamat</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="alamat" id="alamat" class="form-control">{{$perusahaan->alamat}}</textarea>
                                </div>
                            </div>
                        @endif
                            <!-- input email perusahaan -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="">Email Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" disabled value="{{$perusahaan->email_perusahaan}}" class="form-control" name="email_perusahaan" id="email">
                                </div>
                            </div>
                            <!-- input no telp perusahaan -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="">No. Telp Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" required value="{{$perusahaan->no_telp_perusahaan}}" class="form-control" name="no_telp_perusahaan" id="telp">
                                </div>
                            </div>
                        <a class="btn btn-danger" href="/perusahaan/isi_perusahaan_data">Kembali</a>
                        <button class="btn btn-primary float-end" type="submit" onclick="processing()" id="btn">Simpan</button>
                        <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <script>
        // fungsi tombol loading
        function processing() {
            var penempatan = document.getElementById('penempatan').value;
            var telp = document.getElementById('telp').value;
            if (penempatan == "Dalam negeri") {
                var provinsi = document.getElementById('provinsi').value;
                var kota = document.getElementById('kota').value;
                var kecamatan = document.getElementById('kecamatan').value;
                var kelurahan = document.getElementById('kelurahan').value;
                if (provinsi !== '' &&
                    kota !== '' &&
                    kecamatan !== '' &&
                    kelurahan !== '' &&
                    telp !== '') {
                    var submit = document.getElementById('btn').style.display = 'none';
                    var btnLoad = document.getElementById('btnload').style.display = 'block';
                }
            } else {
                var negara = document.getElementById('negara').value;
                var alamat = document.getElementById('alamat').value;
                if (negara !== '' &&
                    alamat !== '' &&
                    telp !== '') {
                    var submit = document.getElementById('btn').style.display = 'none';
                    var btnLoad = document.getElementById('btnload').style.display = 'block';
                }
            }            
        }
    </script>
@endsection
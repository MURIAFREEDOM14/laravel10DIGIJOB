@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">        
        <div class="mb-4">
            <div class="">
                <div class="row">
                    <h4 class="text-center">PERUSAHAAN BIO DATA</h4>
                    <!-- form(post) PerusahaanController => simpan_perusahaan_data -->
                    <form action="/perusahaan/isi_perusahaan_data" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perusahaan_biodata">
                            <div class="row mb-1">
                                <div class="col-md">
                                    <h6 class="ms-4">PERUSAHAAN BIO DATA</h6> 
                                </div>
                            </div>
                            <!-- input nama perusahaan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" disabled required value="{{$perusahaan->nama_perusahaan}}" name="nama_perusahaan" id="perusahaan" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input NIB perusahaan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">NIB Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" disabled required value="{{$perusahaan->no_nib}}" name="no_nib" id="NIB" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input nama pemimpin -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Pemimpin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$perusahaan->nama_pemimpin}}" name="nama_pemimpin" id="pemimpin" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- pilihan alamat perusahaan  -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Alamat Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="tmp_perusahaan" class="form-select" required id="alamat">
                                        <option value="">-- Tentukan Alamat--</option>
                                        <option value="Dalam negeri" @if ($perusahaan->tmp_perusahaan == "Dalam negeri")
                                            selected
                                        @endif>Dalam Negeri</option>
                                        <option value="Luar Negeri" @if ($perusahaan->tmp_perusahaan == "Luar negara")                                            
                                            selected
                                        @endif>Luar Negeri</option>
                                    </select>
                                </div>
                            </div>
                            <!-- input foto perusahaan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($perusahaan->foto_perusahaan == "")
                                        <input type="file" required class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="f_perusahaan" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($perusahaan->foto_perusahaan !== null)
                                        <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Foto Perusahaan/{{$perusahaan->foto_perusahaan}}" width="150" height="150" alt="" class="mb-1">
                                        <input type="file" class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        <input type="text" hidden id="f_perusahaan" value="foto_perusahaan">
                                    @else
                                        <input type="file" required class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="f_perusahaan" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div>
                            <!-- input logo perusahaan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Logo Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($perusahaan->logo_perusahaan == "")
                                        <input type="file" required class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="l_perusahaan" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($perusahaan->logo_perusahaan !== null)
                                        <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Logo Perusahaan/{{$perusahaan->logo_perusahaan}}" width="150" height="150" alt="" class="mb-1">
                                        <input type="file" class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        <input type="text" hidden id="l_perusahaan" value="logo_perusahaan">
                                    @else
                                        <input type="file" required class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="l_perusahaan" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary my-3 float-end" type="submit" onclick="processing()" id="btn">Simpan</button>
                        <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <script>
        function processing() {
            var perusahaan = document.getElementById('perusahaan').value;
            var nib = document.getElementById('NIB').value;
            var pemimpin = document.getElementById('pemimpin').value;
            var alamat = document.getElementById('alamat').value;
            var fperusahaan = document.getElementById('f_perusahaan').value;
            var lperusahaan = document.getElementById('l_perusahaan').value;
            if (perusahaan !== '' &&
                nib !== '' &&
                pemimpin !== '' &&
                alamat !== '' &&
                fperusahaan !== '' &&
                lperusahaan !== '') {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        }
    </script>
@endsection
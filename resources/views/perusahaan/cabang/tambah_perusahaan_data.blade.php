@extends('layouts.input')
@section('content')
    <div class="container mt-5">        
        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PERUSAHAAN BIO DATA</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perusahaan_biodata">
                            <div class="row mb-1">
                                <div class="col-md">
                                    <h6 class="ms-4">PERUSAHAAN BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$perusahaan->nama_perusahaan}}" name="nama_perusahaan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">NIB Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" disabled required value="{{$perusahaan->no_nib}}" name="no_nib" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Pemimpin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$perusahaan->nama_pemimpin}}" name="nama_pemimpin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">{{ __('Perusahaan Anda menempatkan pekerja di:') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="penempatan_kerja" class="form-select" required id="">
                                        <option value="">-- Pilih Penempatan Kerja --</option>
                                        @if($perusahaan->penempatan_kerja == "Dalam negeri")
                                            <option hidden value="Dalam negeri">Dalam Negeri</option>
                                            <option value="Luar Negeri">Luar Negeri</option>
                                        @else
                                            <option value="Dalam negeri">Dalam Negeri</option>
                                            <option hidden value="Luar Negeri">Luar Negeri</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="tmp_perusahaan" class="form-select" required id="">
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
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($perusahaan->foto_perusahaan == "")
                                        <input type="file" class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($perusahaan->foto_perusahaan !== null)
                                        <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Foto Perusahaan/{{$perusahaan->foto_perusahaan}}" width="150" height="150" alt="" class="mb-1">
                                        <input type="file" class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Logo Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($perusahaan->logo_perusahaan == "")
                                        <input type="file" class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($perusahaan->logo_perusahaan !== null)
                                        <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Logo Perusahaan/{{$perusahaan->logo_perusahaan}}" width="150" height="150" alt="" class="mb-1">
                                        <input type="file" class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
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
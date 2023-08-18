@extends('layouts.kandidat')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
@php
    $personal = $kandidat->tinggi;
    $document = $kandidat->foto_ijazah;
    $vaksin = $kandidat->sertifikat_vaksin2;
    $parent = $kandidat->tgl_lahir_ibu;
    $permission = $kandidat->hubungan_perizin;
    $negara = $kandidat->negara_id;                                
@endphp
<div class="container mt-5 my-3">
    @if ($personal == null &&
        $document == null &&
        $vaksin == null &&
        $parent == null &&
        $permission == null)
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="bold">Profil</b>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Harap Lengkapi Profil Anda</h3>
                        <div class="text-center"><a class="btn btn-outline-primary" href="/isi_kandidat_personal">Lengkapi Profil</a></div>                                                            
                    </div>
                </div>
            </div>
        </div>
    @elseif($negara == null)
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="bold">Informasi Perusahaan</b>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Tujuan Bekerja</h3>
                        <div class="text-center">
                            <form action="/isi_kandidat_placement" method="POST">
                                @csrf
                                <select name="penempatan" id="placement" class="form-control">
                                    <option value="">-- Pilih Tujuan Bekerja --</option>
                                    <option value="dalam negeri">Dalam Negeri</option>
                                    <option value="luar negeri">Luar Negeri</option>
                                </select>
                                <div class="" id="hidetext">
                                    <h4 class="">Negara Tujuan</h4>
                                </div>
                                <select name="negara_id" required class="form-control" id="negara_tujuan">
                                    <option value="">-- Pilih Negara --</option>
                                </select>
                                <button type="submit" class="btn btn-primary" id="hidebtn">Simpan</button>
                            </form>
                        </div>                                                            
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="bold">Informasi Perusahaan</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover" >
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 1px">No.</th>
                                        <th>Nama Perusahaan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @if ($kandidat->id_perusahaan !== null)
                                    <tbody>
                                        <tr class="text-center">
                                            <td>1</td>
                                            <td>
                                                {{$perusahaan->nama_perusahaan}}
                                            </td>
                                            <td>
                                                <a href="/profil_perusahaan/{{$perusahaan->id_perusahaan}}">Lihat</a>
                                            </td>
                                        </tr>    
                                    </tbody>    
                                @else
                                    <tbody>
                                        @foreach ($perusahaan_semua as $item)
                                            <tr class="text-center">
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->nama_perusahaan}}
                                                </td>
                                                <td>
                                                    <a href="/profil_perusahaan/{{$item->id_perusahaan}}">Lihat</a>
                                                </td>
                                            </tr>    
                                        @endforeach    
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <b class="bold">Informasi Lowongan Pekerjaan</b>
                    </div>
                    <div class="card-body">
                        @if ($lowongan)
                            @foreach ($lowongan as $item)
                                @if ($item->jenis_kelamin == "MF" || $item->jenis_kelamin == $kandidat->jenis_kelamin)
                                    <div class="row mb-3">
                                        <div class="col-md-12 ">
                                            <div class="input-group mb-3">
                                                <div class="form-control">      
                                                    <marquee behavior="" direction="">{{$item->nama_perusahaan}}, Lowongan: {{$item->jabatan}} </marquee>
                                                </div>
                                                <div class="input-group-append">
                                                    @if ($kandidat->id_perusahaan == null && $kandidat->negara_id !== null)
                                                        <a class="btn btn-outline-primary" href="/profil_perusahaan/{{$item->id_perusahaan}}">Lihat</a>                                        
                                                    @endif
                                                </div>
                                            </div>        
                                        </div>
                                    </div>                                        
                                @endif
                            @endforeach    
                        @endif
                    </div>
                </div>
            </div> --}}
        </div>
    @endif
</div>

    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button> --}}
  
    <!-- Modal -->

    @if ($kandidat->info == null)
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="/info_connect/{{$kandidat->nama}}/{{$kandidat->id_kandidat}}" method="post">
                        @csrf
                        <div class="modal-header">
                            {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> --}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Darimanakah anda mendapat informasi tentang website ini?</h5>
                            <input type="text" required placeholder="Masukkan jawabanmu" name="info" class="form-control" id="info">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" onclick="infoConfirm()" class="btn btn-primary" id="tekan">Selesai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if($persetujuan !== null)
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="/persetujuan_kandidat/{{$kandidat->nama}}/{{$kandidat->id_kandidat}}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h3 class="modal-title" id="staticBackdropLabel">Undangan Interview</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center" id="terimaInterview">
                                <h4 class="">Selamat anda mendapatkan udangan interview dari {{$persetujuan->nama_perusahaan}}</h4>
                                <h5 class="">Apakah anda ingin menyetujuinya?</h5>
                                <button type="submit" name="persetujuan" value="ya" class="btn btn-success" id="">Ya</button>
                                <button type="button" onclick="tidakInterview()" class="btn btn-danger">Tidak</button>    
                            </div>
                            <div class="" id="batalInterview">
                                <h5 class="text-center">Jelaskan alasan anda menolak undangan interview</h5>
                                <select name="pilih" class="form-control my-3" id="tolakInterview">
                                    <option value="">-- Tentukan Pilihanmu --</option>
                                    <option value="bekerja">Sudah bekerja</option>
                                    <option value="alasan">Alasan Lain</option>
                                </select>
                                <div class="" id="bekerja">
                                    <div class="form-group">
                                        <label for="">Dimana anda Bekerja?</label>
                                        <input type="text" name="tmp_bekerja" class="form-control" id="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Anda sekarang bekerja sebagai:</label>
                                        <input type="text" name="jabatan" class="form-control" id="">                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sejak kapan anda bekerja</label>
                                        <input type="date" name="tgl_mulai_kerja" class="form-control" id="">                                    
                                    </div>
                                </div>
                                <div class="form-group" id="alasan">
                                    <label for="">Alasan lain</label>
                                    <textarea name="alasan_lain" class="form-control" id=""></textarea>
                                </div>
                                <button type="submit" class="btn btn-success" name="persetujuan" value="tidak">Kirim Alasan</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- @if($Interview !== null)
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="" method="post">
                        @csrf
                        <div class="modal-header">
                            <h3 class="modal-title" id="staticBackdropLabel">Undangan Interview</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center" id="terimaInterview">
                                <h4 class="">{{$interview->}}</h4>
                                <h5 class="">Apakah anda ingin menyetujuinya?</h5>
                                <button type="submit" onclick="infoConfirm()" name="persetujuan" value="ya" class="btn btn-success" id="">Ya</button>
                                <button type="button" onclick="tidakInterview()" class="btn btn-danger" data-dismiss="modal">Tidak</button>    
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif --}}
@endsection
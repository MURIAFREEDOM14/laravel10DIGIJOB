@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">        
    <div class="">
        <div class="">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <!-- form(post) KandidatController => simpan_kandidat_family -->
                <form action="/isi_kandidat_family" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="" id="family_background">
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <h6 class="ms-5">Data Berkeluarga</h6> 
                            </div>
                        </div>
                        <!-- apabila stats_nikah "menikah" -->
                        @if ($kandidat->stats_nikah == "Menikah")
                            <div class="" id="punya_anak">
                                <!-- jika mempunyai anak -->
                                @if ($keluarga->count() > 0)
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Usia Anak</label>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                @foreach ($keluarga as $item)
                                                    <li class="list-group-item">Anak Ke {{$item->anak_ke}} | Usia {{$item->usia}} Tahun | 
                                                        @if ($item->jenis_kelamin == "M")
                                                            Laki-laki 
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </li>
                                                    <!-- input id anak & tgl anak -->
                                                    <div class="" hidden>
                                                        <input type="number" name="id_anak[]" value="{{$item->id_keluarga}}" id="">
                                                        <input type="date" name="tgl_anak[]" value="{{$item->tgl_lahir_anak}}" id="">    
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- tombol modal tambah data anak -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#data_anak">Tambah Data</button>
                                        </div>
                                    </div>                                    
                                @else
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Apakah anda sudah memiliki anak?</label>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- pilihan modal tambah data anak -->
                                            <select name="" class="form-select" id="anak">
                                                <option value="tidak">Tidak</option>
                                                <option value="ya">Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- input buku foto nikah -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Buku Nikah</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_buku_nikah !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Buku Nikah/{{$kandidat->foto_buku_nikah}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_buku_nikah" id="" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                                        <input type="text" name="" hidden id="f_nikah" value="foto_nikah">
                                    @else
                                        <input type="file" required name="foto_buku_nikah" id="f_nikah" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div>
                            <!-- input nama pasangan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Pasangan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_pasangan}}" name="nama_pasangan" id="namaPasangan" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input tanggal lahir pasangan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Tanggal Lahir Pasangan</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" required class="form-control" name="tgl_lahir_pasangan" value="{{$kandidat->tgl_lahir_pasangan}}" id="tglPasangan">
                                </div>
                            </div>
                            <!-- input pekerjaan pasangan-->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Pekerjaan Pasangan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->pekerjaan_pasangan}}" name="pekerjaan_pasangan" id="kerjaPasangan" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>

                        <!-- apabila stats_nikah "Cerai hidup" -->
                        @elseif ($kandidat->stats_nikah == "Cerai hidup")
                            <div class="" id="punya_anak">
                                <!-- jika mempunyai anak -->
                                @if ($keluarga->count() > 0)
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Usia Anak</label>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                @foreach ($keluarga as $item)
                                                    <li class="list-group-item">Anak Ke {{$item->anak_ke}} | Usia {{$item->usia}} Tahun | 
                                                        @if ($item->jenis_kelamin == "M")
                                                            Laki-laki 
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </li>
                                                    <!-- input id anak & tgl anak -->
                                                    <div class="" hidden>
                                                        <input type="number" name="id_anak[]" value="{{$item->id_keluarga}}" id="">
                                                        <input type="date" name="tgl_anak[]" value="{{$item->tgl_lahir_anak}}" id="">    
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- tombol modal tambah data anak -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#data_anak">Tambah Data</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Apakah anda sudah memiliki anak?</label>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- pilihan modal tambah data anak -->
                                            <select name="" class="form-select" id="anak">
                                                <option value="tidak">Tidak</option>
                                                <option value="ya">Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- input foto cerai -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Surat Keterangan Cerai</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_cerai !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Cerai/{{$kandidat->foto_cerai}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" class="form-control" name="foto_cerai" accept="image/*" id="">                                        
                                        <input type="text" name="" hidden id="f_cerai" value="foto_cerai">
                                    @else
                                        <input type="file" required class="form-control" name="foto_cerai" accept="image/*" id="f_cerai">
                                    @endif
                                </div>
                            </div>
                        <!-- apabila stats_nikah "Cerai mati" -->
                        @elseif ($kandidat->stats_nikah == "Cerai mati") 
                            <div class="" id="punya_anak">
                                <!-- jika mempunyai anak -->
                                @if ($keluarga->count() > 0)
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Usia Anak</label>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                @foreach ($keluarga as $item)
                                                    <li class="list-group-item">Anak Ke {{$item->anak_ke}} | Usia {{$item->usia}} Tahun | 
                                                        @if ($item->jenis_kelamin == "M")
                                                            Laki-laki 
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </li>
                                                    <!-- input id anak & tgl anak -->
                                                    <div class="" hidden>
                                                        <input type="number" name="id_anak[]" value="{{$item->id_keluarga}}" id="">
                                                        <input type="date" name="tgl_anak[]" value="{{$item->tgl_lahir_anak}}" id="">    
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- tombol modal tambah data anak -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#data_anak">Tambah Data</button>
                                        </div>
                                    </div>    
                                @else
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="" class="col-form-label">Apakah anda sudah memiliki anak?</label>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- pilihan modal tambah data anak -->
                                            <select name="" class="form-select" id="anak">
                                                <option value="tidak">Tidak</option>
                                                <option value="ya">Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- input foto bukti kematian pasangan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Akta Kematian Pasangan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_kematian_pasangan !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Kematian Pasangan/{{$kandidat->foto_kematian_pasangan}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" class="form-control" name="foto_kematian_pasangan" accept="image/*" id="">
                                        <input type="text" name="" hidden id="f_kematianPasangan" value="foto_kematian_pasangan">
                                    @else
                                        <input type="file" required class="form-control" name="foto_kematian_pasangan" accept="image/*" id="f_kematianPasangan">
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr>
                    <input type="text" hidden name="" value="{{$kandidat->stats_nikah}}" id="stats_nikah">
                    {{-- <a class="btn btn-warning" href="{{route('vaksin')}}">Lewati</a> --}}
                    <button class="btn btn-primary float-end" type="submit" onclick="processing()" id="btn">Selanjutnya</button>
                    <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                </form>
            </div>
            <hr>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="data_anak" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- form(post) KandidatController => simpan_kandidat_anak -->
            <form action="/isi_kandidat_anak" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- input anak ke -->
                    <div class="form-group mb-2">
                        <label for="" class="">Anak Ke</label>
                        <input type="number" name="anak_ke" required class="form-control" id="">
                    </div>
                    <!-- input jenis kelamin anak -->
                    <div class="form-group mb-2">
                        <label for="" class="">Jenis Kelamin</label>
                        <select name="jk" class="form-select" id="" required>
                            <option value="">-- Jenis Kelamin Anak --</option>
                            <option value="M">Laki-laki</option>
                            <option value="F">Perempuan</option>
                        </select>
                    </div>
                    <!-- input tanggal lahir anak -->
                    <div class="form-group mb-2">
                        <label for="" class="">Tanggal Lahir Anak</label>
                        <input type="date" required name="tgl_lahir_anak" id="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fungsi tombol loading -->
<script>
    function processing() {
        var statsNikah = document.getElementById('stats_nikah').value;
        if (statsNikah == "Menikah") {
            var fnikah = document.getElementById('f_nikah').value;
            var namaPasangan = document.getElementById('namaPasangan').value;
            var tglPasangan = document.getElementById('tglPasangan').value;
            var kerjaPasangan = document.getElementById('kerjaPasangan').value;
            if (fnikah !== '' &&
                namaPasangan !== '' &&
                tglPasangan !== '' &&
                kerjaPasangan !== '') {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        } else if(statsNikah == "Cerai hidup") {
            var fcerai = document.getElementById('f_cerai').value;
            if (fcerai !== '') {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        } else if(statsNikah == "Cerai mati") {
            var fkematianPasangan = document.getElementById('f_kematianPasangan').value;
            if (fkematianPasangan !== '') {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        }
    }
</script>
@endsection
@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header rounded-top bg-primary">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center text-light"><b class="bold" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid white">bio data Profil</b></div>
                        <div class="text-center text-light mt-1"><b class="bold" style="font-size: 15px;">{{$negara->negara}}</b></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" style="line-height:20px">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4"><b class="bold">NO. REGISTER</b></div>
                            <div class="col-sm-6"><b class="bold">: {{$kandidat->jenis_kelamin.$negara->kode_negara}}_{{$kandidat->id_kandidat+800}}</b></div>                
                        </div>
                    </div>
                </div>
                <div class="row ml-5 mt-3 mb-3"><b class="bold">PERSONAL BIO DATA</b></div>
                <div class ="row" style="line-height:20px">
                    <div class="col-sm-9">
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">NAMA LENGKAP</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: {{$kandidat->nama}}</b>
                            </div>        
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">JENIS KELAMIN</b>
                            </div>
                            <div class="col-sm-5">: 
                                @if ($kandidat->jenis_kelamin == "M")
                                    <b class="bold">Laki-Laki</b>
                                @else
                                    <b class="bold">Perempuan</b>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">TEMPAT / TANGGAL LAHIR</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->tmp_lahir}}, {{$tgl_user}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">No. NIK</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->nik}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">No. Telp</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->no_telp}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Agama</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->agama}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Usia</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$usia}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Tinggi / Berat Badan</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: {{$kandidat->tinggi}} cm, {{$kandidat->berat}} kg</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Pendidikan</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->pendidikan}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Alamat</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: Dsn. {{$kandidat->dusun}}, RT/RW : {{$kandidat->rt}}/ {{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Email</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->email}}</b>
                            </div>
                        </div>                                
                    </div>
                    <div class="col-md-3">
                        <div class="float-right mt--5">
                            @if ($kandidat->foto_set_badan !== null)
                                <img class="img" src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" alt="">
                            @else
                                <img class="img" src="/gambar/default_user.png" width="150" height="150" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-5" style="line-height:15px">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <b class="bold">Pengalaman Kerja</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info text-center">
                                                <thead>
                                                <tr class="" style="font-size:10px;">
                                                    <th style="width: 1px;"><b class="bold">No</b></th>
                                                    <th style="width: 1px;"><b class="bold">Nama Perusahaan</b></th>
                                                    <th style="width: 1px;"><b class="bold">Alamat Perusahaan</b></th>
                                                    <th style="width: 1px;"><b class="bold">Jabatan</b></th>
                                                    <th><b class="bold">Periode</b></th>
                                                    <th style="width: 1px"><b class="bold">Alasan Berhenti</b></th>
                                                    <th><b class="bold">Pratinjau Video</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pengalaman_kerja as $item)
                                                        <tr>
                                                            <th><b class="bold">{{$loop->iteration}}</b></th>
                                                            <td><b class="bold">{{$item->nama_perusahaan}}</b></td>
                                                            <td><b class="bold">{{$item->alamat_perusahaan}}</b></td>
                                                            <td><b class="bold">{{$item->jabatan}}</b></td>
                                                            <td><b class="bold">{{date('d-M-Y',strtotime($item->periode_awal))}} - {{date('d-M-Y',strtotime($item->periode_akhir))}}</b></td>
                                                            <td><b class="bold">{{$item->alasan_berhenti}}</b></td>
                                                            <td>
                                                                <a href="/manager/kandidat/galeri_kandidat/{{$item->pengalaman_kerja_id}}" class="btn btn-primary">Lihat Galeri</a>
                                                            </td>                                                    
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-success" href="/manager/kandidat/cetak_surat/{{$kandidat->id_kandidat}}">Cetak Surat Izin & Ahli waris</a>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_kandidat">
                                    Edit Kandidat
                                </button>
                                {{-- <a class="float-right" href="/manager/pilih/permohonan_staff">Kirim Kandidat</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col text-center">
                        <h3 style="font-weight: 600">Orang Tua / Wali</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="">Nama Ayah : {{$kandidat->nama_ayah}}</div>
                        <div class="">Tempat / Tanggal Lahir Ayah : {{$kandidat->tmp_lahir_ayah}}, {{date('d-M-Y',strtotime($kandidat->tgl_lahir_ayah))}}</div>
                        <div class="">Nama Ibu : {{$kandidat->nama_ibu}}</div>
                        <div class="">Tempat / Tanggal Lahir Ibu : {{$kandidat->tmp_lahir_ibu}}, {{date('d-M-Y',strtotime($kandidat->tgl_lahir_ibu))}}</div>
                        <div class="">Alamat Orang Tua : Dsn. {{$kandidat->dusun_parent}}, RT/RW : {{$kandidat->rt_perizin}}/ {{$kandidat->rw_perizin}}, Kel/Desa : {{$kandidat->kelurahan_perizin}}, Kec. {{$kandidat->kecamatan_perizin}}, {{$kandidat->kabupaten_perizin}}, {{$kandidat->provinsi_perizin}}</div>
                        <div class="">Jumlah Saudara Laki-laki : {{$kandidat->jml_sdr_lk}}</div>
                        <div class="">Jumlah Saudara Perempuan : {{$kandidat->jml_sdr_pr}}</div>
                        <div class="">Anak Ke : {{$kandidat->anak_ke}}</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col text-center">
                        <h3 for="" class="text-center" style="font-weight:600">Foto Dokumen</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        @if ($kandidat->foto_ktp !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP/{{$kandidat->foto_ktp}}" width="150" height="150" class="img" alt="">                            
                        @else
                        Gambar belum ada    
                        @endif
                        <p>Foto KTP</p>                        
                    </div>
                    <div class="col-3">
                        @if ($kandidat->foto_kk !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/KK/{{$kandidat->foto_kk}}" width="150" height="150" class="img" alt="">                                                
                        @else
                        Gambar belum ada
                        @endif
                        <p>Foto KK</p>
                    </div>
                    <div class="col-3">
                        @if ($kandidat->foto_set_badan !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" width="150" height="150" class="img" alt="">                                                                            
                        @else
                        Gambar belum ada    
                        @endif
                        <p>Foto Setengah Badan</p>
                    </div>
                    <div class="col-3">
                        @if ($kandidat->foto_4x6 !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" width="150" height="150" class="img" alt="">                                                                                                        
                        @else
                        Gambar belum ada
                        @endif
                        <p>Foto 4x6</p>                        
                    </div>
                    <div class="col-3">
                        @if ($kandidat->foto_ket_lahir !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Ket_lahir/{{$kandidat->foto_ket_lahir}}" width="150" height="150" class="img" alt="">                                                                            
                        @else
                        Gambar belum ada    
                        @endif
                        <p>Foto Ket Lahir</p>
                    </div>
                    <div class="col-3">
                        @if ($kandidat->foto_ijazah !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Ijazah/{{$kandidat->foto_ijazah}}" width="150" height="150" class="img" alt="">                                                                            
                        @else
                        Gambar belum ada    
                        @endif
                        <p>Foto Ijazah</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col text-center">
                        <h3 style="font-weight: 600">Foto Vaksinasi</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        @if ($kandidat->sertifikat_vaksin1 !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Vaksin Pertama/{{$kandidat->sertifikat_vaksin1}}" width="150" height="150" class="img" alt="">                                                                            
                        @else
                        Gambar belum ada    
                        @endif
                        <div>Vaksin Pertama : {{$kandidat->vaksin1}}</div>
                        <div>Batch ID : {{$kandidat->no_batch_v1}}</div>
                        <div>Tanggal Vaksin : {{date('d-M-Y',strtotime($kandidat->tgl_vaksin1))}}</div>
                    </div>
                    <div class="col-3">
                        @if ($kandidat->sertifikat_vaksin2 !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Vaksin Kedua/{{$kandidat->sertifikat_vaksin2}}" width="150" height="150" class="img" alt="">                                                                            
                        @else
                        Gambar belum ada    
                        @endif
                        <div>Vaksin Kedua : {{$kandidat->vaksin2}}</div>
                        <div>Batch ID : {{$kandidat->no_batch_v2}}</div>
                        <div>Tanggal Vaksin : {{date('d-M-Y',strtotime($kandidat->tgl_vaksin2))}}</div>
                    </div>
                    <div class="col-3">
                        @if ($kandidat->sertifikat_vaksin3 !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Vaksin Ketiga/{{$kandidat->sertifikat_vaksin3}}" width="150" height="150" class="img" alt="">                                                                            
                        @else
                        Gambar belum ada    
                        @endif
                        <div>Vaksin Ketiga : {{$kandidat->vaksin3}}</div>
                        <div>Batch ID : {{$kandidat->no_batch_v3}}</div>
                        <div>Tanggal Vaksin : {{date('d-M-Y',strtotime($kandidat->tgl_vaksin3))}}</div>
                    </div>
                </div>
                @if ($kandidat->stats_nikah !== "Single")
                <hr>
                    <div class="row">
                        <div class="col text-center">
                            <h3 style="font-weight: 600">Status Pernikahan</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="">Status Pernikahan : {{$kandidat->stats_nikah}}</div>
                            @if ($kandidat->stats_nikah == "Menikah")
                                <div class="">Nama Pasangan : {{$kandidat->nama_pasangan}}</div>
                                <div class="">Umur Pasangan : {{$kandidat->umur_pasangan}}</div>
                                <div class="">Pekerjaan Pasangan : {{$kandidat->pekerjaan_pasangan}}</div>
                            @endif
                            <div class="">Jumlah anak Laki-laki : {{$kandidat->jml_anak_lk}}</div>
                            <div class="">Umur anak Laki-laki : {{$kandidat->umur_anak_lk}}</div>
                            <div class="">Jumlah anak Perempuan : {{$kandidat->jml_anak_pr}}</div>
                            <div class="">Umur anak Perempuan : {{$kandidat->umur_anak_pr}}</div>
                        </div>
                        <div class="col-3">
                            @if ($kandidat->stats_nikah == "Menikah")
                                @if ($kandidat->foto_buku_nikah !== null)
                                    <img src="/gambar/Kandidat/{{$kandidat->nama}}/Buku Nikah/{{$kandidat->foto_buku_nikah}}" width="150" height="150" class="img" alt="">                                                                            
                                @else
                                Gambar belum ada    
                                @endif    
                            @elseif($kandidat->stats_nikah == "Cerai hidup")
                                @if ($kandidat->foto_cerai !== null)
                                    <img src="/gambar/Kandidat/{{$kandidat->nama}}/Cerai/{{$kandidat->foto_cerai}}" width="150" height="150" class="img" alt="">                                                                            
                                @else
                                Gambar belum ada    
                                @endif
                            @elseif($kandidat->stats_nikah == "Cerai mati")
                                @if ($kandidat->foto_kematian_pasangan !== null)
                                    <img src="/gambar/Kandidat/{{$kandidat->nama}}/Kematian Pasangan/{{$kandidat->foto_kematian_pasangan}}" width="150" height="150" class="img" alt="">                                                                            
                                @else
                                Gambar belum ada    
                                @endif
                            @else    
                            @endif
                        </div>
                    </div>    
                @endif
                <hr>
                <div class="row">
                    <div class="col text-center">
                        <h3 style="font-weight: 600">Kontak Darurat</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <div class="">Hubungan Pemberi Izin : {{$kandidat->hubungan_perizin}}</div>
                        <div class="">Nama Pemberi Izin : {{$kandidat->nama_perizin}}</div>
                        <div class="">No. NIK Pemberi Izin : {{$kandidat->nik_perizin}}</div>
                        <div class="">No. Telp Pemberi Izin : {{$kandidat->no_telp_perizin}}</div>
                        <div class="">Tempat Lahir Pemberi Izin : {{$kandidat->tmp_lahir_perizin}}</div>
                        <div class="">Tanggal Lahir Pemberi Izin : {{$kandidat->tgl_lahir_perizin}}</div>
                        <div class="">Alamat Pemberi Izin : Dsn. {{$kandidat->dusun_perizin}}, RT {{$kandidat->rt_perizin}} / RW {{$kandidat->rw_perizin}}, Kec. {{$kandidat->kecamatan_perizin}}, Kab. {{$kandidat->kabupaten_perizin}}, {{$kandidat->provinsi_perizin}}</div>
                    </div>
                    <div class="col-3">
                        @if ($kandidat->foto_ktp_izin !== null)
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP Perizin/{{$kandidat->foto_ktp_izin}}" width="150" height="150" class="img" alt="">                                                                            
                        @else
                        Gambar belum ada    
                        @endif
                    </div>
                </div>
                @if ($kandidat->no_paspor !== null)
                    <hr>
                    <div class="row">
                        <div class="col text-center">
                            <h3 style="font-weight: 600">Passport</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="">No. Passport : {{$kandidat->no_paspor}}</div>
                            <div class="">Nama Pemilik Passport : {{$kandidat->pemilik_paspor}}</div>
                            <div class="">Tanggal Terbit : {{date('d-M-Y',strtotime($kandidat->tgl_terbit_paspor))}}</div>
                            <div class="">Tanggal Akhir : {{date('d-M-Y',strtotime($kandidat->tgl_akhir_paspor))}}</div>
                            <div class="">Tempat Penerbitan : {{$kandidat->tmp_paspor}}</div>
                        </div>
                        <div class="col-3">
                            @if ($kandidat->foto_paspor !== null)
                                <img src="/gambar/Kandidat/{{$kandidat->nama}}/Paspor/{{$kandidat->foto_paspor}}" width="150" height="150" class="img" alt="">                                                                            
                            @else
                            Gambar belum ada    
                            @endif
                        </div>
                    </div>
                @endif
            </div>        
        </div>
    </div>        
    <!-- Modal -->
    <div class="modal fade" id="video_kerja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="video_kerja2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja2/{{$kandidat->video_kerja2}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="video_kerja3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja3/{{$kandidat->video_kerja3}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>         --}}
    <div class="modal fade" id="edit_kandidat" tabindex="-1" aria-labelledby="edit_kandidat" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Bagian Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <a href="/manager/edit/kandidat/personal/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Personal</a>
                        <a href="/manager/edit/kandidat/document/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Document</a>
                        <a href="/manager/edit/kandidat/vaksin/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Vaksin</a>
                        <a href="/manager/edit/kandidat/family/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Family</a>        
                    </p>
                    <p>
                        <a href="/manager/edit/kandidat/parent/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Parent</a>
                        <a href="/manager/edit/kandidat/permission/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Permission</a>
                        <a href="/manager/edit/kandidat/placement/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Placement</a>
                        <a href="/manager/edit/kandidat/job/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Job</a>        
                    </p>
                    <p>
                        <a href="/manager/edit/kandidat/company/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Company</a>
                        <a href="/manager/edit/kandidat/paspor/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Paspor</a>        
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        
    </script>
@endsection
@extends('layouts.kandidat')
@section('content')
<div class="mx-3 mt-5 my-5">
    <div class="card">
        <div class="card-header">
            <b class="bold">Jadwal Interview Perusahaan</b>
        </div>
        <div class="card-body">
            <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase; background-image: linear-gradient(#0C356A, #279EFF);color:white;">Lowongan Pekerjaan</div>
            <div class="row my-3" style="text-transform: uppercase;">
                <div class="col-md-3">
                    <label for="" class="" style="font-weight:700">Nama Perusahaan</label>
                </div>
                <div class="col-md-6">
                    <label for="" class="">| {{$interview->nama_perusahaan}}</label>
                </div>
            </div>
            <div class="row my-3" style="text-transform: uppercase">
                <div class="col-md-3">
                    <label for="" class="" style="font-weight:700">Nama Lowongan</label>
                </div>
                <div class="col-md-6">
                    <label for="" class="">| {{$interview->jabatan}}</label>
                </div>
            </div>
            <div class="row my-3" style="text-transform: uppercase">
                <div class="col-md-3">
                    <label for="" style="font-weight:700;">Bekerja Sebagai</label>
                </div>
                <div class="col-md-6">
                    <label for="">| {{$interview->lvl_pekerjaan}}</label>
                </div>
            </div>
            <div class="text-center my-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Lihat Detail Lowongan Pekerjaan
                </button>
            </div>
            <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase; background-image: linear-gradient(#0C356A, #279EFF);color:white;">Jadwal Interview</div>
            <div class="row my-3" style="text-transform: uppercase;">
                <div class="col-md-3">
                    <label for="" class="" style="font-weight:700">Tanggal Interview</label>
                </div>
                <div class="col-md-9">
                    <label for="" class="">: {{date('d M Y',strtotime($interview->jadwal_interview))}}</label>
                </div>
            </div>
            <div class="row my-3" style="text-transform:uppercase;">
                <div class="col-md-3">
                    <label class="" style="font-weight:700">Waktu Interview</label>
                </div>
                <div class="col-md-9">
                    <label class="">: {{date('h:i:s a',strtotime($interview->waktu_interview_awal))}} Sampai {{date('h:i:s a',strtotime($interview->waktu_interview_akhir))}}</label>
                </div>
            </div>
            <div class="row my-3" style="text-transform: uppercase;">
                <div class="col-md-3">
                    <label for="" class="" style="font-weight:700">Status</label>
                </div>
                <div class="col-md-9">
                    <label for="" class="">: 
                        @if ($interview->status == "terjadwal")
                            Belum Interview
                        @elseif($interview->status == "dimulai")
                            Sedang Interview
                        @elseif($interview->status == "berakhir")
                            Sudah Interview
                        @endif                  
                    </label>
                </div>
            </div>
            @php
                $tgl_now = date('d M Y');
                $tgl_interview = date('d M Y',strtotime($interview->jadwal_interview));
                $time_now = date('h:i:s a');
                $time_interview_begin = date('h:i:s a',strtotime($interview->waktu_interview_awal.('-15 minutes')));
                $time_interview_ended = date('h:i:s a',strtotime($interview->waktu_interview_akhir));
            @endphp
            <div class="row">
                <!-- apabila tgl sekarang lebih besar dari tanggal interview & waktu sekarang lebih dari dengan waktu interview dimulai -->
                @if($tgl_now >= $tgl_interview && $time_now > $time_interview_begin)
                    <!-- apabila waktu sekarang lebih dari waktu interview berakhir -->
                    @if ($time_now > $time_interview_ended)
                        <div class="col-md-8">
                            <label for="" class="form-label">Waktu interview anda dengan perusahaan ini telah habis. Mohon tunggu keputusan dari pihak perusahaan.</label>                            
                        </div>
                    @else
                        <div class="col-8">
                            <label for="" class="form-label float-left" style="padding: 0px;">Interview anda dengan kandidat akan segera dimulai. Harap segera masuk ke dalam portal</label>
                        </div>
                        <div class="col-4">
                            <a class="float-right btn btn-outline-success" style="padding: 10px; text-decoration:none; border:1px solid green; border-radius:0% 20% 0% 20%;" href="">Masuk Portal</a>
                        </div>    
                    @endif
                @endif
            </div>
            <div class="" style="border-top: 1px solid black; margin-top:7px;">
                <b>Catatan</b>
                <div class="">Harap untuk menyegarkan halaman ini / masuk kembali ke halaman ini apabila waktu interview akan segera dimulai.</div>    
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Penempatan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{($interview->negara)}}</b></div>
                        </div>
                    </div>
                    <hr>
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Judul Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{($interview->jabatan)}}</b></div>
                        </div>
                    </div>
                    <hr>
                    @if ($interview->lvl_pekerjaan !== null)
                        <div  class="row">
                            <div class="col-md-3">
                                <label for="" class="">Jenis Pekerjaan</label>
                            </div>
                            <div class="col-md-8">
                                <div class=""><b class="bold">: {{($interview->lvl_pekerjaan)}}</b></div>
                            </div>
                        </div>
                        <hr>    
                    @endif
                    @if ($interview->isi !== null)
                        <div  class="row">
                            <div class="col-md-3">
                                <label for="" class="">Deskripsi Pekerjaan</label>
                            </div>
                            <div class="col-md-8">
                                <div class=""><b class="bold">: {{($interview->isi)}}</b></div>
                            </div>
                        </div>
                        <hr>    
                    @endif
                    @if ($interview->gambar_lowongan !== null)
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Gambar</label>
                            </div>
                            <div class="col-md-4">
                                <img src="/gambar/Perusahaan/{{$interview->nama_perusahaan}}/Lowongan Pekerjaan/{{$interview->gambar_lowongan}}" width="250" height="250" alt="" class="img">                            
                            </div>
                        </div>    
                        <hr>
                    @endif
                    <div  class="row">
                        <div class="col-md-3">
                            <h5><b class="bold">Persyaratan</b></h5>
                        </div>
                    </div>
                    <hr>
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Jenis Kelamin</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: 
                                @if ($interview->jenis_kelamin == "M")
                                    Laki-laki    
                                @elseif($interview->jenis_kelamin == "F")
                                    Perempuan
                                @else
                                    Laki-laki & Perempuan
                                @endif
                            </b></div>
                        </div>
                    </div>
                    <hr>
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Pendidikan Minimal</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{$interview->pendidikan}}</b></div>
                        </div>
                    </div>
                    <hr>
                    @if ($interview->usia_min !== null && $interview->usia_maks !== null)
                        <div  class="row">
                            <div class="col-md-3">
                                <label for="" class="">Syarat Usia</label>
                            </div>
                            <div class="col-md-8">
                                <div class=""><b class="bold">: {{$interview->usia_min}} tahun Sampai {{$interview->usia_maks}} tahun</b></div>
                            </div>
                        </div>
                        <hr>
                    @elseif($interview->usia_min !== null)
                        <div  class="row">
                            <div class="col-md-3">
                                <label for="" class="">Syarat Usia Minimal</label>
                            </div>
                            <div class="col-md-8">
                                <div class=""><b class="bold">: {{$interview->usia_min}} tahun</b></div>
                            </div>
                        </div>
                        <hr>
                    @endif
                    @if ($interview->negara !== "Indonesia")
                        <div  class="row">
                            <div class="col-md-3">
                                <label for="" class="">Pengalaman Kerja</label>
                            </div>
                            <div class="col-md-8">
                                <div class=""><b class="bold">: {{$interview->pengalaman_kerja}}</b></div>
                            </div>
                        </div>
                        <hr>    
                    @endif
                    @if ($interview->tinggi !== null)
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Tinggi Badan Minimal</label>
                            </div>
                            <div class="col-md-3">
                                <b class="bold">: {{$interview->tinggi}}</b>
                            </div>
                        </div>
                        <hr>
                    @endif
                    @if ($interview->berat_min !== null && $interview->berat_maks !== null)
                        <div  class="row">
                            <div class="col-md-3">
                                <label for="" class="">Berat Badan Minimal</label>
                            </div>
                            <div class="col-md-3">
                                <div class=""><b class="bold">: {{$interview->berat_min}}</b></div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="">Berat Badan Maksimal</label>
                            </div>
                            <div class="col-md-3">
                                <div class=""><b class="bold">: {{$interview->berat_maks}}</b></div>                            
                            </div>
                        </div>
                        <hr>
                    @elseif($interview->berat_min !== null)
                        <div  class="row">
                            <div class="col-md-3">
                                <label for="" class="">Berat Badan Minimal</label>
                            </div>
                            <div class="col-md-3">
                                <div class=""><b class="bold">: {{$interview->berat_min}}</b></div>
                            </div>
                        </div>
                        <hr>            
                    @endif
                    @if ($interview->pencarian_tmp !== null)
                        <div  class="row">
                            <div class="col-md-3">
                                <label for="" class="">Area Rekrut Pekerja</label>
                            </div>
                            <div class="col-md-8">
                                <div class=""><b class="bold">: {{$interview->pencarian_tmp}}</b></div>
                            </div>
                        </div>
                        <hr>    
                    @endif
                    @if ($interview->fasilitas !== null)
                    <div  class="row">
                        <div class="col-12">
                            <h5><b class="bold">Fasilitas</b></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="">Fasilitas Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{$interview->fasilitas}}</b></div>
                        </div>
                    </div>
                    <hr>
                    @endif
                    @if ($interview->benefit == null && $interview->mata_uang == null)
                    @else
                        <div class="row">
                            <div class="col-12">
                                <h5><b class="bold">Benefit</b></h5>
                            </div>
                        </div>
                        <hr>
                        @if ($interview->benefit !== null)
                            <div  class="row">
                                <div class="col-md-3">
                                    <label for="" class="">Benefit Pekerjaan</label>
                                </div>
                                <div class="col-md-8">
                                    <div class=""><b class="bold">: {{($interview->benefit)}}</b></div>
                                </div>
                            </div>
                            <hr>    
                        @endif
                        @if ($interview->mata_uang !== null)
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="">Mata Uang</label>
                                </div>
                                <div class="col-md-4">
                                    <div class=""><b class="bold">: {{($interview->mata_uang)}}</b></div>
                                </div>
                            </div>
                            <hr>
                            <div  class="row">
                                <div class="col-md-3">
                                    <label for="" class="">Informasi Gaji</label>
                                </div>
                                <div class="col-md-3">
                                    <div class=""><b class="bold">: Gaji Minimum : {{($interview->gaji_minimum)}}</b></div>
                                </div>
                                <div class="col-md-3">
                                    <div class=""><b class="bold">Gaji Maksimum : {{($interview->gaji_maksimum)}}</b></div>
                                </div>
                            </div>
                            <hr>
                        @endif
                    @endif
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Kode Undangan Perusahaan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{$interview->referral_code}}</b></div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
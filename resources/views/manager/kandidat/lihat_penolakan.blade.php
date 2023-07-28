@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight: 600; text-transform:uppercase">Detail Penolakan Kandidat Kepada Perusahaan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="">Nama Kandidat</label>
                    </div>
                    <div class="col-8">
                        <div style="text-transform: uppercase">: {{$penolakan->nama}}</div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="">Nama Perusahaan</label>
                    </div>
                    <div class="col-8">
                        <div style="text-transform: uppercase">: {{$penolakan->nama_perusahaan}}</div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-12">
                        <h5 style="font-weight: 600">Alasan Menolak</h5>
                    </div>
                </div>
                <hr>
                @if ($penolakan->alasan_lain == null)
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Alasan</label>
                        </div>
                        <div class="col-8">
                            <div style="text-transform: uppercase" class="">: Sudah Bekerja</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Tempat Bekerja</label>
                        </div>
                        <div class="col-8">
                            <div style="text-transform: uppercase" class="">: {{$penolakan->tmp_bekerja}}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">jabatan</label>
                        </div>
                        <div class="col-8">
                            <div style="text-transform: uppercase" class="">: {{$penolakan->jabatan}}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Tanggal Mulai Kerja</label>
                        </div>
                        <div class="col-8">
                            <div style="text-transform: uppercase" class="">: {{date('d-M-Y',strtotime($penolakan->tgl_mulai_kerja))}}</div>
                        </div>
                    </div>
                    <hr>
                @else
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Alasan</label>
                        </div>
                        <div class="col-8">
                            <div style="text-transform: uppercase" class="">: {{$penolakan->alasan_lain}}</div>
                        </div>
                    </div>
                    <hr>
                @endif
                <a class="btn btn-danger" href="/manager/kandidat/penolakan_kandidat">Kembali</a>
            </div>
        </div>
    </div>
@endsection
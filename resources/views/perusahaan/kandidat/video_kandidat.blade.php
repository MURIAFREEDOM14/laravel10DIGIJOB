@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Video Pengalaman Kerja
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <video width="330" controls>
                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/{{$kandidat_pengalaman_kerja->video_pengalaman_kerja}}" type="video/mp4">
                        </video>
                    </div>
                    <div class="col-md-6">
                        <b class="bold">Nama Pengalaman Kerja : {{$kandidat_pengalaman_kerja->nama_perusahaan}}</b>
                        <hr>
                        <b class="bold">Alamat Pengalaman Kerja : {{$kandidat_pengalaman_kerja->alamat_perusahaan}}</b>
                        <hr>
                        <b class="bold">Jabatan : {{$kandidat_pengalaman_kerja->jabatan}}</b>
                        <hr>
                        <b class="bold">Periode : {{date('d-M-Y',strtotime($kandidat_pengalaman_kerja->periode_awal))}} Sampai {{date('d-M-Y',strtotime($kandidat_pengalaman_kerja->periode_akhir))}}</b>
                        <hr>
                        <b class="bold">Alasan Berhenti : {{$kandidat_pengalaman_kerja->alasan_berhenti}}</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr style="font-size:12px;">
                                <th>No.</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Perusahaan</th>
                                <th>Jabatan</th>
                                <th>Periode</th>
                                <th>Alasan Berhenti</th>
                                <th>Video</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengalaman_kerja as $item)
                                <tr>
                                    @if ($item->pengalaman_kerja_id == $kandidat_pengalaman_kerja->pengalaman_kerja_id)                                        
                                    @elseif($item->video_pengalaman_kerja !== null)
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->nama_perusahaan}}</td>
                                        <td>{{$item->alamat_perusahaan}}</td>
                                        <td>{{$item->jabatan}}<input hidden name="jabatan[]" value="{{$item->jabatan}}" id=""></td>
                                        <td>{{date('d-M-Y',strtotime($item->periode_awal))}} - {{date('d-M-Y',strtotime($item->periode_akhir))}}</td>
                                        <td>{{$item->alasan_berhenti}}</td>
                                        <td>
                                            <a href="/lihat_video_pengalaman_kerja/{{$item->pengalaman_kerja_id}}" class="btn btn-primary">Lihat Video</a>
                                        </td>
                                    @else
                                    @endif
                                </tr>                                    
                            @endforeach
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.manager')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Video Pengalaman Kerja
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <video width="330" id="video">
                        <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/{{$kandidat->video_pengalaman_kerja}}" type="video/mp4">
                    </video>
                    <button type="button" class="btn btn-success" onclick="playPause()">Mulai / Jeda</button>
                </div>
                <div class="col-md-6">
                    <b class="bold">Nama Pengalaman Kerja : {{$kandidat->nama_perusahaan}}</b>
                    <hr>
                    <b class="bold">Alamat Pengalaman Kerja : {{$kandidat->alamat_perusahaan}}</b>
                    <hr>
                    <b class="bold">Jabatan : {{$kandidat->jabatan}}</b>
                    <hr>
                    <b class="bold">Periode : {{date('d-M-Y',strtotime($kandidat->periode_awal))}} Sampai {{date('d-M-Y',strtotime($kandidat->periode_akhir))}}</b>
                    <hr>
                    <b class="bold">Alasan Berhenti : {{$kandidat->alasan_berhenti}}</b>
                    <hr>
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
                                @if ($item->pengalaman_kerja_id == $kandidat->pengalaman_kerja_id)                                        
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
<script>
    var video = document.getElementById("video");
    function playPause() {
        if (video.paused) {
            video.play();
        } else {
            video.pause();
        }
    }
</script>
@endsection
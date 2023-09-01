@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Konfirmasi Jadwal Interview</b>
            </div>
            <div class="card-body">
                <form action="/perusahaan/konfirmasi_interview/{{$id}}" method="POST">
                    @csrf
                    @foreach ($kandidat_interview as $item)
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase;">Data kandidat</div>
                                <div class="row my-3" style="text-transform: uppercase">
                                    <div class="col-2">
                                        <label for="">Nama Kandidat</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="id_kandidat[]" hidden value="{{$item->id_kandidat}}" id="">
                                        <label for="">| {{$item->nama}}</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="">| {{$item->usia}} tahun</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="">| 
                                            @if ($item->jenis_kelamin == "M")
                                                Laki-laki
                                            @else
                                                Perempuan
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <div class="text-center" style="border-bottom: 2px solid black; border-top: 2px solid black; text-transform:uppercase;">Jadwal Interview</div>
                                <div class="row my-3" style="text-transform: uppercase;">
                                    <div class="col-md-3">
                                        <label for="" class="" style="font-weight:700">Tanggal Interview</label>
                                        <br>
                                        <div class="my-2">
                                            <label for="" style="font-weight:700">Waktu Awal</label>
                                            <br>
                                            <label for="" style="font-weight:700">Waktu Akhir</label>
                                            <br>    
                                            <label class="" style="font-weight:700">Waktu Interview</label>
                                        </div>
                                        <label for="" class="" style="font-weight:700">Istirahat</label>
                                    </div>
                                    <div class="col-md-9">
                                        <label for="" class="">: {{date('d M Y',strtotime($item->jadwal_interview))}}</label>
                                        <br>
                                        <div class="my-2">
                                            @if ($item->urutan !== 1)
                                                <input type="text" hidden name="interview_awal[]" value="{{date('h:i:s',strtotime($item->waktu_interview_awal.('+10 minutes')))}}" id="">
                                                <input type="text" hidden name="durasi[]" id="" value="{{$item->durasi_interview}}">
                                                <label for="">: {{date('h:i:s a',strtotime($item->waktu_interview_awal))}} + 10 Menit</label>
                                                <br>
                                                <label for="">: {{date('h:i:s a',strtotime($item->waktu_interview_akhir))}} + 10 Menit</label>
                                                <br>
                                                <label class="">: {{date('h:i:s a',strtotime($item->waktu_interview_awal.('+10 minutes')))}} Sampai {{date('h:i:s a',strtotime($item->waktu_interview_akhir.('+10 minutes')))}}</label>                                        
                                            @else
                                                <input type="text" hidden name="interview_awal[]" value="{{date('h:i:s',strtotime($item->waktu_interview_awal))}}" id="">
                                                <input type="text" hidden name="durasi[]" id="" value="{{$item->durasi_interview}}">
                                                <label for="">: {{date('h:i:s a',strtotime($item->waktu_interview_awal))}}</label>
                                                <br>
                                                <label for="">: {{date('h:i:s a',strtotime($item->waktu_interview_akhir))}}</label>
                                                <br>
                                                <label class="">: {{date('h:i:s a',strtotime($item->waktu_interview_awal))}} Sampai {{date('h:i:s a',strtotime($item->waktu_interview_akhir))}}</label>
                                            @endif
                                        </div>
                                        <label for="">: + 10 Menit </label>    
                                    </div>
                                </div>
                                <div class="" style="border-top:1px solid black; margin:5px;">
                                    Waktu istirahat ditambahkan setelah waktu interview pertama selesai.
                                </div>
                            </div>
                        </div>    
                    @endforeach
                    <button type="submit" class="btn btn-success float-right">Konfirmasi Interview</button>
                    <a class="btn btn-warning" href="/perusahaan/jadwal_interview/{{$id}}">Edit ulang Jadwal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
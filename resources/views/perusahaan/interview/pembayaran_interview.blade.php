@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Pembayaran Interview</b>
            </div>
            <div class="card-body">
                <form action="/perusahaan/pembayaran_interview/{{$id}}" method="POST">
                    @csrf
                    <div class="row" style="text-transform: uppercase;">
                        <div class="col-3">
                            <label for="">Nama Perusahaan</label>
                            <hr>
                        </div>
                        <div class="col-9">
                            @php
                                $total = count($id_kandidat);
                            @endphp
                            <label for="">: {{$perusahaan->nama_perusahaan}}</label>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="text-transform: uppercase;">
                        <div class="col-3">
                            <label for="">Judul Pembayaran</label>
                            <hr>
                        </div>
                        <div class="col-9">
                            <label for="">: {{$lowongan->jabatan}}</label>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="text-transform: uppercase;">
                        <div class="col-3">
                            <label for="">Total Kandidat Interview</label>
                            <hr>
                        </div>
                        <div class="col-9">
                            <p>
                                <label for="">: {{$total}}</label>
                                <button class="btn btn-outline-primary float-right" style="line-height: 5px;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Lihat Kandidat
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                @foreach ($kandidat_interview as $item)
                                    <div class="card" style="padding:15px;background-image:linear-gradient(#0C356A, #279EFF);">
                                        <div for="" style="color: white;">{{$item->urutan}} | {{$item->nama}}</div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="text-transform: uppercase;">
                        <div class="col-3">
                            <label for="">Nominal Pembayaran</label>
                            <hr>
                        </div>
                        <div class="col-9">
                            <label for="">: 15000 X {{$total}}</label>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="text-transform: uppercase;">
                        <div class="col-3">
                            <label for="">Total Pembayaran</label>
                            <hr>
                        </div>
                        <div class="col-9">
                            <input type="text" hidden name="biaya" value="{{15000 * $total}}" id="">
                            <label for="">: {{15000 * $total}}</label>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="text-transform: uppercase;">
                        <div class="col-3">
                            <label for="">Credit Anda
                                <button type="button" style="border-radius: 50%; border:0.5px solid gray; background-color:white;" class="" data-toggle="tooltip" data-placement="right" title="Credit ini digunakan untuk memberi potongan biaya untuk interview yang akan anda lakukan.">
                                    ?
                                </button>
                            </label>
                            <hr>
                        </div>
                        <div class="col-9">
                            <input type="text" hidden name="credit" value="{{$credit->credit}}" id="">
                            <label for="">: 
                                @if ($credit->credit == null || $credit->credit == 0)
                                    0
                                @else
                                    {{$credit->credit}}
                                @endif
                            </label>
                            <hr>
                        </div>
                    </div>
                    @if ($credit->credit == 0)
                        <button type="submit" class="btn btn-success" name="konfirmasi" value="tidak">Konfirmasi Pembayaran</button>
                    @else
                        <div class="text-center" style="text-transform: uppercase; border:2px solid #337CCF; padding:15px;">
                            <label for="">Apakah anda ingin menggunakan credit anda untuk pembayaran interview ini?</label>
                            <div class="mt-3">
                                <button class="btn btn-success" type="submit" name="konfirmasi" value="ya">Ya</button>
                                <button class="btn btn-danger" type="submit" name="konfirmasi" value="tidak">Tidak</button>    
                            </div>
                        </div>    
                    @endif
                    
                    <hr>
                    <a class="btn btn-warning" href="/perusahaan/jadwal_interview/{{$id}}">Atur Kembali Jadwal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
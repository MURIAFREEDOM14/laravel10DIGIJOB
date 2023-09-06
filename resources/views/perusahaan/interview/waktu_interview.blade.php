@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="">Waktu Interview</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Nama Kandidat</h5>
                    </div>
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Waktu Interview</h5>
                    </div>
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Durasi Interview</h5>
                    </div>
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Jadwal Interview</h5>
                    </div>
                </div>
                <form action="/perusahaan/waktu_interview/{{$id}}" method="POST">
                    @csrf
                    @foreach ($kandidat as $item)
                        <div class="row mb-2">
                            <div class="col-3">
                                <label for="" style="text-transform:uppercase;" class="col-form-label">{{$loop->iteration}}. {{$item->nama}}</label>
                                <input type="text" hidden name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                            </div>
                            <div class="col-3">
                                <input type="time" name="timer[]" required class="form-control" id="">
                            </div>
                            <div class="col-3">
                                <select name="durasi[]" class="form-control" id="">
                                    <option value="5">5 Menit</option>
                                    <option value="10">10 Menit</option>
                                    <option value="15">15 Menit</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="text" disabled name="" class="form-control" id="" value="{{date('d M Y',strtotime($item->jadwal_interview))}}">
                            </div>
                        </div>
                    @endforeach
                    <div class="" style="border-top:1px solid black; padding:2px; margin-top:20px; font-size:16px; font-weight:600;">Catatan :</div>
                    <div class="" style="border-bottom:1px solid black; padding:2px; margin-bottom:20px; font-size:14px; font-weight:400;">Untuk setiap selesai interview akan diberikan sebuah waktu istirahat 10 menit sebelum interview berikutnya. Jadi harap untuk memastikan kembali waktu yang anda tentukan supaya tidak saling bertumpukan. Terima kasih</div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>                
            </div>
        </div>
    </div>
@endsection
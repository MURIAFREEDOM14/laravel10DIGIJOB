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
                </div>
                <form action="" method="POST">
                    @csrf
                    @foreach ($kandidat as $item)
                        <div class="row mb-2">
                            <div class="col-3">
                                <label for="" style="text-transform:uppercase;" class="col-form-label">{{$item->urutan}}. {{$item->nama}}</label>
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
                        </div>
                    @endforeach
                    <button type="submit" class="btn text-white" style="background-color: green">Simpan</button>
                </form>                
            </div>
        </div>
    </div>
@endsection
@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="text-transform: uppercase; font-weight:bold;">Tanggal Interview</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Nama Kandidat</h5>
                    </div>
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Tanggal Interview</h5>
                    </div>
                    <div class="col-3">
                        <h5 for="" style="text-transform: uppercase; font-weight:bold; border-bottom:1px solid black;" class="text-center">Urutan Kandidat</h5>
                    </div>
                </div>
                <!-- form(post)  -->
                <form action="" method="post">
                    @csrf
                    @foreach ($kandidat as $nama)
                        <div class="row mb-2">    
                            <div class="col-3">
                                <label for="" style="text-transform:uppercase;" class="col-form-label">{{$loop->iteration}}. {{$nama->nama}}</label>
                                <input type="number" hidden name="id_kandidat[]" value="{{$nama->id_kandidat}}" id="">
                            </div>
                            <div class="col-3">
                                <select class="form-control"  name="dater[]" id="">
                                    @foreach ($jadwal as $time)
                                        <option value="{{$time}}">{{date('d M Y',strtotime($time))}}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="urutan[]" required class="form-control" id="">
                                    <option value="">-- Tentukan urutan --</option>
                                    @foreach ($kandidat as $item)
                                        <option value="{{$loop->iteration}}">{{$loop->iteration}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>    
    </div>
@endsection
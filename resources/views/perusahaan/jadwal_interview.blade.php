@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="">Jadwal Interview</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    @foreach ($range as $item)
                        <li class="nav-item">
                            <a class="nav-link" id="pills-home-tab" href="/perusahaan/waktu_interview/{{$id}}/{{date('Y-m-d',strtotime($item))}}" >{{date('d M Y',strtotime($item))}}</a>
                        </li>    
                    @endforeach
                </ul>
                <form action="" method="POST">
                    @csrf
                    <h5 for="" class="" style="font-weight: bold">Tanggal Interview : {{date('d M Y',strtotime($time))}}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            @if ($interview->waktu_interview == null && $interview->jadwal_interview == null)
                                <div class="form-group">
                                    <label for="">Waktu Mulai Interview</label>
                                    <input type="time" name="waktu" value="" required class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Waktu Interval Interview</label>
                                    <select name="interval" class="form-control" id="">
                                        <option value="">Tentukan Waktu Interval</option>
                                        <option value="5">5 Menit</option>
                                        <option value="10">10 Menit</option>
                                        <option value="15">15 Menit</option>
                                    </select>
                                </div>
                            @elseif($interview->waktu_interview !== null && $interview->jadwal_interview !== $time)
                                <div class="form-group">
                                    <label for="">Waktu Mulai Interview</label>
                                    <input type="time" name="waktu" value="" required class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Waktu Interval Interview</label>
                                    <select name="interval" class="form-control" id="">
                                        <option value="">Tentukan Waktu Interval</option>
                                        <option value="5">5 Menit</option>
                                        <option value="10">10 Menit</option>
                                        <option value="15">15 Menit</option>
                                    </select>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="">Waktu Mulai Interview</label>
                                    <input type="time" name="waktu" disabled value="{{$interview->waktu_interview}}" required class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Waktu Interval Interview</label>
                                    <select name="interval" class="form-control" id="">
                                        <option value="">Tentukan Waktu Interval</option>
                                        <option value="5" @if ($interview->interval == "5")
                                            selected
                                        @endif>5 Menit</option>
                                        <option value="10" @if ($interview->interval == "10")
                                            selected
                                        @endif>10 Menit</option>
                                        <option value="15" @if ($interview->interval == "15")
                                            selected
                                        @endif>15 Menit</option>
                                    </select>
                                </div>
                            @endif                        
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 style="text-transform:uppercase">Informasi Interview</h5>
                                </div>
                                <div class="card-body">
                                    <div style="">Waktu Interview : 15 Menit</div>
                                    <div style="">Jeda Istirahat Antar Interview : 10 Menit</div>
                                </div>
                            </div>
                        </div>                            
                    </div>
                    <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn text-white" style="background-color: green">Simpan</button>
                </form>                
            </div>
        </div>
        @if ($interview->waktu_interview !== null && $interview->jadwal_interview == $time)
            <div class="card">
                <div class="card-header">
                    <h5 style="">Kandidat</h5>
                </div>
                <div class="card-body">

                </div>
            </div>    
        @endif
    </div>
@endsection
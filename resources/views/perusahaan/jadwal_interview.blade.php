@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Jadwal Interview
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">                        
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Nama Kandidat</label>
                                        @foreach ($interview as $item)
                                            <input type="text" class="form-control mb-2" name="nama[]" value="{{$item->nama_kandidat}}" id="">
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jadwal Interview</label>
                                        <input type="datetime-local" name="jadwal_interview" value="" required class="form-control" id="">
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <a href="/perusahaan/interview" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn text-white" style="background-color: green">Simpan</button>
                </form>                
            </div>
        </div>
    </div>
@endsection
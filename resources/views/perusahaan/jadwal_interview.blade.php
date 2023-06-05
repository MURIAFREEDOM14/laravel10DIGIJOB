@extends('layouts.perusahaan')
@section('content')
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
                                    <input type="datetime-local" name="jadwal_interview[]" value="" required class="form-control" id="">
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
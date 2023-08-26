@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Seleksi Kandidat</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @foreach ($kandidat_interview as $item)
                        <div class="row">
                            <div class="col-md-1">
                                <input type="checkbox" name="" id="">
                            </div>
                            <div class="col-md-3">
                                <label for="" style="font-weight: 700; text-transform:uppercase;" class="">{{$item->nama}}</label>
                            </div>
                            <div class="col-md-8">
                                <label for="" style="font-weight: 700; text-transform:uppercase;">|  |  |</label>
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
@endsection
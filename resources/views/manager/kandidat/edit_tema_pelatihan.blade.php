@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 style="font-weight:600">Video Pelatihan</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($video as $item)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            {{$item->judul}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 style="font-weight: 600">Tema Pelatihan</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <label for="" class="">Nama Tema</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="tema" required value="{{$pelatihan->tema_pelatihan}}" id="">    
                                <div class="input-group-append">
                                  <button class="btn btn-warning" type="submit" id="button-addon2">Ubah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
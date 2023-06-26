@extends('layouts.manager')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">Reset Data Kandidat</b></h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <select name="id_kandidat" class="form-control" id="">
                            <option value="">Cari kandidat</option>
                            @foreach ($kandidat as $item)
                                <option value="{{$item->id_kandidat}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" onclick="return confirm('reset?')" type="submit" id="button-addon2">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
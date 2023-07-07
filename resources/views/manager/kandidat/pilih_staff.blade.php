@extends('layouts.manager')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <b class="bold">Pilih Staff</b>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($staff as $item)
                        <div class="col-4">
                            <div class="card">
                                
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="input-group">
                    <label for="">Kirimkan Kepada</label>
                    <select name="" id="">
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($permohonan as $item)
                            <option value="{{$item->id_perusahaan}}">{{$item->nama_perusahaan}}</option>                            
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
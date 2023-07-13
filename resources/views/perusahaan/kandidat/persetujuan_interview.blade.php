@extends('layout.perusahaan')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 style="font-weight: 600">Persetujuan Interview</h3>
            </div>
            <div class="card-body">
                <div class="form-input">
                    @foreach ($kandidat as $item)
                        <label for="" class="col-form-label">{{$item->nama}}</label>                        
                        <select name="" disabled id="">
                            <option value="" @if ($)
                                
                            @endif></option>
                            <option value=""></option>
                        </select>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
<div class="container mt-5">        
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <h6 class="text-center mb-5" style="text-transform: uppercase">
                    @if ($kandidat->penempatan == null)
                    @else
                        {{$kandidat->penempatan}}
                    @endif
                </h6>
                <div class="" id="perizin">
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <h6 class="ms-5">Data Penempatan Kerja</h6> 
                        </div>
                    </div>
                    <form action="/isi_kandidat_placement" method="post">
                        @csrf
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Pilih Penempatan Negara</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <select name="negara_id" required class="form-select" id="negara">
                                        <option value="">-- Pilih Negara --</option>
                                        @foreach ($negara as $item)
                                            <option value="{{$item->negara_id}}" @if ($kandidat->negara_id == $item->negara_id)selected @endif>{{$item->negara}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <a class="btn btn-warning" href="{{route('permission')}}">Lewati</a>
                        <button type="submit" class="btn btn-primary float-end">Selanjutnya</button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
@endsection
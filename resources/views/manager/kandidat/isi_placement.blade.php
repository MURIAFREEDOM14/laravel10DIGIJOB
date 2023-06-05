@extends('layouts.manager')

@section('content')
    <div class="container mt-5">        
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <h4 class="mx-auto">PERSONAL BIO DATA</h4>
                </div>
                <div class="">
                    <h6 class="text-center mb-5">Indonesia</h6>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perizin">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">Data Penempatan Kerja</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Pilih Penempatan Negara</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="negara_id" required class="form-control" id="">
                                        <option value="">-- Pilih Negara --</option>
                                        @foreach ($negara as $item)
                                            <option value="{{$item->negara_id}}" @if ($kandidat->negara_id == $item->negara_id)selected @endif>{{$item->negara}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 style="font-weight: 600">Verifikasi Diri Anda</h5>
                    </div>
                    <div class="card-body">
                        <form action="/kirim_verifikasi_diri" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="" class="col-form-label">Foto Diri dan Foto KTP</label>
                                    <input type="file" required name="photo_id" placeholder="kirim foto anda dan foto KTP anda disini" class="form-control" id="" accept="image/*" capture="camera">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
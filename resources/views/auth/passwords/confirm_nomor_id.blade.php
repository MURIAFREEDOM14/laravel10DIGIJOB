@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">
                            @if ($user->type == 2)
                                No. NIB
                            @elseif($user->type == 1)
                                No. NIS
                            @else
                                No. Telp
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="/nomor_id" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    @if ($user->type == 2)
                                        <label for="col-form-label">No. NIB</label>
                                        <input type="number" name="no" disabled class="form-control" value="{{$user->no_nib}}" id="">
                                    @elseif($user->type == 1)
                                        <label for="col-form-label">No. NIS</label>
                                        <input type="number" name="no" disabled class="form-control" value="{{$user->no_nis}}" id="">
                                    @else
                                        <label for="col-form-label">No. Telp</label>
                                        <input type="number" name="no" disabled class="form-control" value="{{$user->no_telp}}" id="">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="col-form-label">Kode Verifikasi</label>
                                    <input type="text" name="referral_code" required class="form-control" placeholder="Masukkan Kode Verifikasi Anda" id="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Lanjut</button>
                        </form>
                        @if ($user->type == 0)
                            <div class="">Apakah No. Telp anda mati atau tidak bisa digunakan? Gunakan <a class="" href="/confirm_alternative_id">cara ini</a></div>                            
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
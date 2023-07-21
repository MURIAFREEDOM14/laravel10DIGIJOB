@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
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
                                        <label for="col-form-label">Masukkan No. NIB</label>
                                    @elseif($user->type == 1)
                                        <label for="col-form-label">Masukkan No. NIS</label>
                                    @else
                                        <label for="col-form-label">Masukkan No. Telp</label>
                                    @endif
                                    <input type="number" name="no" required class="form-control" id="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Lanjut</button>
                        </form>
                        {{-- <div class="row">
                            <div class="col">

                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
@endsection
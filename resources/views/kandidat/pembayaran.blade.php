@extends('layouts.kandidat')
@section('content')
    <div class="container mt-3">
        @if ($pembayaran->stats_pembayaran !== null)
            {{-- confirm email send --}}
            <div class="card">
                <div class="card-body text-center">
                    <b class="">Kami telah mengirim pembayaran dengan email anda</b>
                    <p><b class="">Silahkan cek email anda untuk proses pembayaran</b></p>
                </div>
            </div>
            
            {{-- confirmation payment --}}
            <div class="card">
                <div class="card-header">
                    <b class="bold">Konfirmasi Pembayaran</b>
                </div>
                <div class="card-body">
                    <form action="" method="POST"></form>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Nama Kandidat</label>
                        </div>
                        <div class="col-8">
                            <input disabled type="text" class="form-control" value="{{$pembayaran->nama_pembayaran}}" name="" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">No. NIK</label>
                        </div>
                        <div class="col-8">
                            <input disabled type="text" class="form-control" value="{{$pembayaran->nik}}" name="" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Nominal Pembayaran</label>
                        </div>
                        <div class="col-8">
                            <input disabled type="text" class="form-control" value="{{$pembayaran->nominal_pembayaran}}" name="" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Foto Bukti Pembayaran</label>
                        </div>
                        <div class="col-8">
                            <input type="file" class="form-control" name="pembayaran" id="">
                        </div>
                    </div>
                </div>
            </div>

            {{-- resend email payment --}}
            <div class="card">
                <div class="card-body text-center">
                    Apakah kamu belum mendapatkan pesan email?
                    <p><a class="btn" href="/pembayaran">Kirim Ulang</a></p>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <b class="bold">Pembayaran</b>
                </div>
                <div class="card-body">
                    <form action="/payment" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="" class="col-form-label"><b class="bold">Nama</b></label>
                            </div>
                            <div class="col-8">
                                <div class=""><b class="bold">: {{$kandidat->nama}}</b></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="" class="col-form-label"><b class="bold">No. NIK</b></label>
                            </div>
                            <div class="col-8">
                                <div class=""><b class="bold">: {{$kandidat->nik}}</b></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="" class="col-form-label"><b class="bold">Nominal Pembayaran</b></label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="text-transform: uppercase; font-family:poppins;">Rp.</span>
                                    <input disabled type="number" class="form-control" value="{{15000}}">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <div class="col-4">
                                <label for=""><b class="bold">Bukti Pembayaran</b></label>
                            </div>
                            <div class="col-8">
                                <input type="file" required class="form-control" name="foto_pembayaran" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                            </div>
                        </div> --}}
                        <a href="{{route('kandidat')}}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-success float-right">Upgrade</button>    
                    </form>
                </div>    
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@endsection
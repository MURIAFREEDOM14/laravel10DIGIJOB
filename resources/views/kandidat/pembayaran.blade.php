@extends('layouts.kandidat')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body text-center">
                <b class="">Kami telah mengirim pembayaran dengan email anda</b>
                <p><b class="">Silahkan cek emailmu untuk melihat pembayaran</b></p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <b class="" style="text-transform: uppercase;">Pembayaran</b>
            </div>
            <div class="card-body">
                <form action="/payment" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for=""><b class="bold">Nama</b></label>
                        </div>
                        <div class="col-8">
                            <div class=""><b class="bold">: {{$kandidat->nama}}</b></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for=""><b class="bold">No. NIK</b></label>
                        </div>
                        <div class="col-8">
                            <div class=""><b class="bold">: {{$kandidat->nik}}</b></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for=""><b class="bold">Nominal Pembayaran</b></label>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1" style="text-transform: uppercase; font-family:poppins;">Rp.</span>
                                <input disabled type="number" class="form-control" value="{{15000}}">
                                <input hidden type="number" name="nominal_pembayaran" class="form-control" value="{{1000000}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for=""><b class="bold">Bukti Pembayaran</b></label>
                        </div>
                        <div class="col-8">
                            <input type="file" required class="form-control" name="foto_pembayaran" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                        </div>
                    </div>
                    <a href="/" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-success float-right">Bayar</button>    
                </form>
            </div>    
        </div>
        <div class="card">
            <div class="card-body text-center">
                Apakah kamu belum mendapatkan pesan email?
                <p><a class="btn" href="/pembayaran">Kirim Ulang</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@endsection
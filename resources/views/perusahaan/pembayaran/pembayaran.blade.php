@extends('layouts.perusahaan')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
    <div class="container mt-5">
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
                <!-- apabila data pembayaran perusahaan ada -->
                @if ($pembayaran !== null)
                    <!-- apabila foto pembayaran kosong -->
                    @if ($pembayaran->foto_pembayaran == null)
                        <!-- form(post) PerusahaanController => paymentCheck -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for=""><b class="bold">Nama</b></label>
                                </div>
                                <div class="col-8">
                                    <div class=""><b class="bold">: {{$perusahaan->nama_perusahaan}}</b></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for=""><b class="bold">No. NIB</b></label>
                                </div>
                                <div class="col-8">
                                    <div class=""><b class="bold">: {{$perusahaan->no_nib}}</b></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for=""><b class="bold">Judul Pembayaran</b></label>
                                </div>
                                <div class="col-8">
                                    <!-- apabila data pembayaran interview -->
                                    @if ($pembayaran->id_lowongan !== null)
                                        <div class=""><b class="bold">: Interview {{$pembayaran->jabatan}}</b></div>                                        
                                    @else
                                        <div class=""><b class="bold">: --</b></div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for=""><b class="bold">Waktu Transaksi Dibuat</b></label>
                                </div>
                                <div class="col-8">
                                    <div class=""><b class="bold">: {{date('d M Y | h:i:s',strtotime($pembayaran->created_at))}}</b></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for=""><b class="bold">Nominal Pembayaran</b></label>
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1" style="text-transform: uppercase; font-family:poppins;">Rp.</span>
                                        <input type="number" disabled class="form-control disable" value="{{15000}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for=""><b class="bold">Total Pembayaran</b></label>
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1" style="text-transform: uppercase; font-family:poppins;">Rp.</span>
                                        <input type="number" disabled class="form-control disable" value="{{$pembayaran->nominal_pembayaran}}">
                                    </div>
                                </div>
                            </div>
                            <!-- input foto bukti pembayaran -->
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for=""><b class="bold">Bukti Pembayaran</b></label>
                                </div>
                                <div class="col-8">
                                    <input type="file" required class="form-control" name="foto_pembayaran" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success float-right">Bayar</button>    
                        </form>
                    @else
                        <h5>Pembayaran anda sedang kami proses</h5>
                    @endif
                        
                @else
                    <div class="card">
                        <div class="card-body text-center">
                            Apakah kamu belum mendapatkan pesan email?
                            <p><a class="btn" href="/perusahaan/pembayaran">Kirim Ulang</a></p>
                        </div>
                    </div>
                    <h5>Maaf belum ada pembayaran</h5>
                @endif
                <a href="/perusahaan" class="btn btn-danger">Kembali</a>
            </div>    
        </div>
    </div>
@endsection
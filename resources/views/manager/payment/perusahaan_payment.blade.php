@extends('layouts.payment')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="">List Pembayaran Kandidat</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $item)
                                @if ($item->stats_pembayaran !== "sudah dibayar")
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->nama_pembayaran}}</td>
                                        <td>
                                            <a class="btn" href="/manager/lihat/payment/perusahaan/{{$item->id_pembayaran}}">Lihat Perusahaan</a>
                                        </td>
                                    </tr>    
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 style="">Riwayat Pembayaran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_pembayaran}}</td>
                                    <td>
                                        <a class="btn" href="/manager/lihat/payment/perusahaan/{{$item->id_pembayaran}}">Lihat Perusahaan</a>
                                    </td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                List Pembayaran
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Pembayaran</th>
                                <th>Waktu Transaksi Dibuat</th>
                                <th>Bukti Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nominal_pembayaran}}</td>
                                    <td>{{date('d M Y|h:i:s ',strtotime($item->created_at))}}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="/perusahaan/payment/{{$item->id_pembayaran}}" class="btn btn-success mr-2">Serahkan Bukti</a>
                                        </div>
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
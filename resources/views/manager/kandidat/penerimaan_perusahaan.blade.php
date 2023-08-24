@extends('layouts.manager')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4><b class="bold">List Kandidat</b></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover" >
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kandidat as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->provinsi}}, {{$item->kabupaten}}</td>
                                <td>
                                    <a class="btn" href="/manager/kandidat/lihat_penerimaan_perusahaan/{{$item->id_kandidat}}">Pilih Kandidat</a>
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
@extends('layouts.manager')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <b class="bold">Permohonan Pencarian Staff</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No,</th>
                            <th>Nama Perusahaan</th>
                            <th>Pekerjaan</th>
                            <th>Kebutuhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonan as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama_perusahaan}}</td>
                                <td>{{$item->pekerjaan}}</td>
                                <td>{{$item->jml_kebutuhan}}</td>
                                <td>
                                    <a class="btn btn-primary" href="/manager/lihat/permohonan_staff/{{$item->pencarian_staff_id}}">Lihat</a>
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
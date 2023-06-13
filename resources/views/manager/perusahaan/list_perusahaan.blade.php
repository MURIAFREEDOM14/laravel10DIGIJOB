@extends('layouts.manager')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Data Perusahaan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama Pemimpin</th>
                            <th>No. NIB</th>
                            <th>Email Perusahaan</th>
                            <th>Lihat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perusahaan as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>                                    
                                <td>{{$item->nama_perusahaan}}</td>                                    
                                <td>{{$item->nama_pemimpin}}</td>                                    
                                <td>{{$item->no_nib}}</td>                                    
                                <td>{{$item->email_perusahaan}}</td>                                    
                                <td>
                                    <a class="btn btn-primary" href="/manager/perusahaan/lihat_profil/{{$item->id_perusahaan}}"><i class="fas fa-eye"></i></a>
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
@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 style="text-transform: uppercase">Verifikasi Email</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengguna as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>                                    
                                    <td>{{$item->email}}</td>                                    
                                    <td>
                                        <a class="btn btn-primary" href="/manager/email_verify/{{$item->id}}"><i class="fas fa-eye"></i></a>
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
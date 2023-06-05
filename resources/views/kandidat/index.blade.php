@extends('layouts.kandidat')
@section('content')
@include('sweetalert::alert')
<div class="container mt-5 my-3">
    <div class="row mt-2">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <b class="bold">Data Perusahaan</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 1px">No.</th>
                                    <th>Logo Perusahaan</th>
                                    <th>Lihat Profil Perusahaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perusahaan as $item)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if ($item->logo_perusahaan == null)
                                                <img src="/gambar/default_user.png" width="150" alt="">    
                                            @else
                                                <img src="/gambar/Perusahaan/Logo/{{$item->logo_perusahaan}}" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-info" href="/profil_perusahaan/{{$item->id_perusahaan}}">Lihat Profil</a>
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <b class="bold"></b>
                </div>
                <div class="card-body text-center">
                    <b>Dalam pembangunan</b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
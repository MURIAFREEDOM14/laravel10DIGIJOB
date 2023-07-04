@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">Kode Undangan Perusahaan</b></h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" required placeholder="Masukkan Kode Undangan" name="referral_code" id="">                            
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                        </div>
                    </div>
                </form>
                @if ($kandidat->hubungan_perizin !== null)
                    @if ($cari_perusahaan !== null)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Nama Perusahaan</th>
                                        <th scope="col">No. Telp Perusahaan</th>
                                        <th scope="col">Tempat Perusahaan</th>
                                        <th scope="col">Lihat Profil Perusahaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>{{$cari_perusahaan->nama_perusahaan}}</td>
                                        <td>{{$cari_perusahaan->no_telp_perusahaan}}</td>
                                        <td>{{$cari_perusahaan->tmp_negara}}</td>
                                        <td>
                                            <a class="btn btn-info" href="/profil_perusahaan/{{$cari_perusahaan->id_perusahaan}}">Lihat Profil</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">List Informasi Perusahaan</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th style="width: 1px">No.</th>
                                <th>Nama Perusahaan</th>
                                <th>No. Telp Perusahaan</th>
                                <th>Lihat Profil Perusahaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perusahaan as $item)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$item->nama_perusahaan}}
                                    </td>
                                    <td>{{$item->no_telp_perusahaan}}</td>
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
@endsection
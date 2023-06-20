@extends('layouts.kandidat')
@section('content')
@include('sweetalert::alert')
<div class="container mt-5 my-3">
    <div class="row mt-2">
        <div class="col-md-7">
            {{-- <div class="card mb-3" style="background-color: #1269db">
                <div class="card-body">
                    <div class="text-white" style="border-bottom:2px solid white"><b class="word" style="font-size: 13px;">Hai, apakah kamu penasaran ingin melihat informasi perusahaan?</b></div>
                </div>
            </div> --}}
            {{-- <input type="text" name="" value="{{$kandidat->nama}}" id="nama">
            <input type="text" name="" value="{{$kandidat->id_kandidat}}" id="id"> --}}
            {{-- <input type="text" value="{{$kandidat->negara_id}}" name="negara_id" id="negara_id"> --}}
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
                                    <th>Nama Perusahaan</th>
                                    <th>Lihat Profil Perusahaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perusahaan as $item)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            {{-- @if ($item->logo_perusahaan == null)
                                                <img src="/gambar/default_user.png" width="150" height="150" alt="">    
                                            @else
                                                <img src="/gambar/Perusahaan/{{$item->nama_perusahaan}}/Logo Perusahaan/{{$item->logo_perusahaan}}" alt="" width="150" height="150">
                                            @endif --}}
                                            {{$item->nama_perusahaan}}
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

    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button> --}}
  
    <!-- Modal -->
    @if ($kandidat->info !== null)
    @else
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="/info_connect/{{$kandidat->nama}}/{{$kandidat->id_kandidat}}" method="post">
                        @csrf
                        <div class="modal-header">
                            {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> --}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Darimanakah anda mendapat informasi tentang website ini?</h5>
                            <input type="text" required placeholder="Masukkan jawabanmu" name="info" class="form-control" id="info">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" onclick="infoConfirm()" class="btn btn-primary" id="tekan">Selesai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @endif
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).on('load',function() {
            $('#staticBackdrop').modal('show');                                                   
        });
    </script>
@endsection
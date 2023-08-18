@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Semua Notifikasi
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($notif as $item)
                        <div class="col-12" style="">
                            <a class="" style="color: black;" href="{{$item->url}}">
                                <h5 class="float-left">{{$item->pengirim}}</h5>
                                <small class="float-right">{{date('d-m-Y',strtotime($item->created_at))}}</small>
                                <br>
                                <h6 class="">{{$item->isi}}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="table-responsive">
                    <table class="table table-bordered table-head-bg-primary table-bordered-bd-primary">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Dari</th>
                                <th>Isi Pesan</th>
                                <th>URL</th>
                                <th>Waktu Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notif as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->pengirim}}</td>
                                <td>{{$item->isi}}</td>
                                <td>
                                    @if ($item->url == null)
                                        <a>---</a>
                                    @else
                                        <a href="{{$item->url}}" class="btn btn-primary">Shorcut</a>                                    
                                    @endif
                                </td>
                                <td>{{date('d-M-Y | h:m',strtotime($item->created_at)) }}</td>
                            </tr>                                
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
                <hr>
                <div class="">Notifikasi akan terhapus dalam 2 minggu</div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@endsection
@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <hr>
        <div class="card">
            <div class="card-header">
                Semua Notifikasi
            </div>
            <div class="card-body">
                <table class="table table-bordered table-head-bg-primary table-bordered-bd-primary">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Dari</th>
                            <th>Isi Pesan</th>
                            <th>Waktu Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notif as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->pengirim}}</td>
                            <td>{{$item->isi}}</td>
                            <td>{{date('d-m-Y | h:m:sa',strtotime($item->created_at)) }}</td>
                        </tr>                                
                        @endforeach
                    </tbody>
                </table>
                <div class="">Notifikasi akan terhapus dalam 2 minggu</div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@endsection
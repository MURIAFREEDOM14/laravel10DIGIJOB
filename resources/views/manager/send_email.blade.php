@extends('layouts.manager')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 style="text-transform: uppercase">Kirim Ulang Email</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="" class="">Nama Pengguna</label>
                        @if ($pengguna->type == 2)
                            <input type="text" name="nama" value="{{$pengguna->name_perusahaan}}" id="">                            
                        @elseif($pengguna->type == 1)
                            <input type="text" name="nama" value="{{$pengguna->name_akademi}}" id="">
                        @elseif($pengguna->type == 0)
                            <input type="text" name="nama" value="{{$pengguna->name}}" id="">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="">Email</label>
                        <input type="email" name="email" value="{{$pengguna->email}}" id="">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
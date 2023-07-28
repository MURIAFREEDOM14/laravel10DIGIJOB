@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 style="font-weight: bold; text-transform:uppercase">Persetujuan Kandidat</h3>
            </div>
            <div class="card-body">
                @if ($isi !== 0)
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            @foreach ($kandidat as $item)
                                @if ($item->persetujuan !== "tidak")
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header">
                                                {{$item->nama}}
                                                <span class="float-right">
                                                    @if ($item->persetujuan == "ya")
                                                        <i class="far fa-check-circle" style="color: green"></i>                                            
                                                    @elseif($item->persetujuan == "tidak")
                                                        <i class="far fa-times-circle" style="color: red"></i>
                                                    @else
                                                        <i class="fas fa-clock" style="color: gray"></i>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <span>
                                                    @if ($item->persetujuan == "ya")
                                                        Kandidat menyetujui
                                                        <input type="text" hidden name="menerima[]" value="{{$item->id_kandidat}}" id="">
                                                    @elseif($item->persetujuan == "tidak")
                                                        Kandidat menolak
                                                        <input type="text" hidden name="menolak[]" value="{{$item->id_kandidat}}" id="">
                                                    @else
                                                        Menunggu persetujuan
                                                        <input type="text" hidden name="menunggu[]" value="{{$item->id_kandidat}}" id="">
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>    
                                @endif
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Tentukan Jadwal Interview</button>
                    </form>
                @else
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="" style="font-weight: bold">Maaf, Tidak ada kandidat yang anda pilih</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
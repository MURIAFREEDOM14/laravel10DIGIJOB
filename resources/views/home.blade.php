@extends('layouts.manager')

@section('content')
    <div class="container">
        @if (auth()->user()->type == 3)
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Kandidat</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No telp</th>
                                    <th>cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kandidat as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>
                                        <a href="/cetak/{{$item->id_kandidat}}">Cetak</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @elseif (auth()->user()->type == 2)
        
        @elseif (auth()->user()->type == 1)
        
        @else
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Biodata Diri
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

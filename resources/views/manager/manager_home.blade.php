@extends('layouts.manager')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Beranda</h2>
                <h5 class="text-white op-7 mb-2" style="text-transform: uppercase">Digijob - Ugiport</h5>
            </div>
            {{-- <div class="ml-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                <a href="#" class="btn btn-secondary btn-round">Add Customer</a>
            </div> --}}
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">statistik kandidat baru hari ini</div>
                    <div class="card-category"> informasi statistik harian di sistem</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-1"></div>
                            <h6 class="fw-bold mt-3 mb-0">Kandidat Baru</h6>
                            <p>{{$ttl_baru_kandidat}}</p>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-2"></div>
                            <h6 class="fw-bold mt-3 mb-0">Akademi Baru</h6>
                            <p>{{$ttl_baru_akademi}}</p>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-3"></div>
                            <h6 class="fw-bold mt-3 mb-0">Perusahaan Baru</h6>
                            <p>{{$ttl_baru_perusahaan}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Total income & spend statistics</div>
                    <div class="row py-3">
                        <div class="col-md-4 d-flex flex-column justify-content-around">
                            <div>
                                <h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
                                <h3 class="fw-bold">$9.782</h3>
                            </div>
                            <div>
                                <h6 class="fw-bold text-uppercase text-danger op-8">Total Spend</h6>
                                <h3 class="fw-bold">$1,248</h3>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="chart-container">
                                <canvas id="totalIncomeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Statistik Pengguna Aplikasi Hari Ini</div>
                        <div class="card-tools">
                            {{-- <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                <span class="btn-label">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                Export
                            </a> --}}
                            {{-- <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Print
                            </a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <label for="">Kandidat Masuk</label>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{$total_kandidat}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="{{$semua_kandidat}}">{{$total_kandidat}}</div>
                    </div>
                    <label for="">Akademi Masuk</label>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{$total_akademi}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="{{$semua_akademi}}">{{$total_akademi}}</div>
                    </div>
                    <label for="">Perusahaan Masuk</label>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$total_perusahaan}}%" aria-valuenow="" aria-valuemin="0" aria-valuemax="{{$semua_perusahaan}}">{{$total_perusahaan}}</div>
                    </div>
                    {{-- <div class="chart-container" style="min-height: 375px">
                        <canvas id="multipleBarChart"></canvas>
                    </div> --}}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Statistik Pengguna Mingguan</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="multipleBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">Daily Sales</div>
                    <div class="card-category">March 25 - April 02</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1>$4,578.58</h1>
                    </div>
                    <div class="pull-in">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body pb-0">
                    <div class="h1 fw-bold float-right text-warning">+7%</div>
                    <h2 class="mb-2">213</h2>
                    <p class="text-muted">Transactions</p>
                    <div class="pull-in sparkline-fix">
                        <div id="lineChart"></div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">Penempatan Kerja Kandidat</h4>
                        <div class="card-tools">
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-angle-down"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span class="fa fa-sync-alt"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                    {{-- <p class="card-category">
                    Map of the distribution of users around the world</p> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <tbody>
                                        @foreach ($negara_tujuan as $item)
                                            <tr>
                                                {{-- <td>
                                                    <div class="flag">
                                                        <img src="/Atlantis/examples/assets/img/flags/id.png" alt="indonesia">
                                                    </div>
                                                </td> --}}
                                                <td>{{$item->negara}}</td>
                                                <td class="text-right">
                                                    {{$item->mata_uang}}
                                                </td>
                                                <td class="text-right">
                                                    @foreach ($kandidat as $number)
                                                        @php
                                                            $total = $number->negara_id == $item->negara_id;
                                                            
                                                        @endphp
                                                    @endforeach
                                                </td>
                                            </tr>    
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mapcontainer">
                                <div id="map-example" class="vmap"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Penempatan Terbanyak</div>
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="/Atlantis/examples/assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h6 class="fw-bold mb-1">CSS</h6>
                            <small class="text-muted">Cascading Style Sheets</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$17</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="/Atlantis/examples/assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                            <small class="text-muted">The Best Donuts</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$300</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="/Atlantis/examples/assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h6 class="fw-bold mb-1">Ready Pro</h6>
                            <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$350</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="pull-in">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title float-left">Kontak Akademi</div>
                    <a href="/manager/akademi/list_akademi" class="float-right">Lainnya</a>
                </div>
                <div class="card-body">
                    <div class="card-list">
                        @foreach ($akademi_list as $item)
                            <div class="item-list">
                                <div class="avatar">
                                    @if ($item->logo_akademi !== null)
                                        <img src="/gambar/Akademi/{{$item->nama_akademi}}/Logo Akademi/{{$item->logo_akademi}}" alt="..." class="avatar-img rounded-circle">                                        
                                    @else
                                        <img src="/gambar/default_user.png" alt="" class="avatar-img rounded-circle">
                                    @endif
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">{{$item->nama_akademi}}</div>
                                </div>
                                <a class="btn-primary btn-round btn-xs" href="/manager/akademi/lihat_profil/{{$item->id_akademi}}">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title float-left">Kontak Perusahaan</div>
                    <a href="/manager/perusahaan/list_perusahaan" class="float-right">Lainnya</a>
                </div>
                <div class="card-body">
                    <div class="card-list">
                        @foreach ($perusahaan_list as $item)
                            <div class="item-list">
                                <div class="avatar">
                                    @if ($item->logo_perusahaan !== null)
                                        <img src="/gambar/Perusahaan/{{$item->nama_perusahaan}}/Logo Perusahaan/{{$item->logo_perusahaan}}" alt="..." class="avatar-img rounded-circle">                                        
                                    @else
                                        <img src="/gambar/default_user.png" alt="" class="avatar-img rounded-circle">
                                    @endif
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">{{$item->nama_perusahaan}}</div>
                                </div>
                                <a class="btn-primary btn-round btn-xs" href="/manager/perusahaan/lihat_profil/{{$item->id_perusahaan}}">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-title">Jadwal Acara</div>
                </div>
                <div class="card-body">
                    <ol class="activity-feed">
                        <li class="feed-item feed-item-secondary">
                            <time class="date" datetime="9-25">Sep 25</time>
                            <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                        </li>
                        <li class="feed-item feed-item-success">
                            <time class="date" datetime="9-24">Sep 24</time>
                            <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                        </li>
                        <li class="feed-item feed-item-info">
                            <time class="date" datetime="9-23">Sep 23</time>
                            <span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
                        </li>
                        <li class="feed-item feed-item-warning">
                            <time class="date" datetime="9-21">Sep 21</time>
                            <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                        </li>
                        <li class="feed-item feed-item-danger">
                            <time class="date" datetime="9-18">Sep 18</time>
                            <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                        </li>
                        <li class="feed-item">
                            <time class="date" datetime="9-17">Sep 17</time>
                            <span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">List Pekerja</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="avatar avatar-online">
                            <span class="avatar-title rounded-circle border border-white bg-info">N</span>
                        </div>
                        <div class="flex-1 ml-3 pt-1">
                            <h6 class="text-uppercase fw-bold mb-1"> Nama Pekerja <span class="text-warning pl-3">???</span></h6>
                            <span class="text-muted">Bekerja di bidang .....</span>
                        </div>
                        <div class="float-right pt-1">
                            <small class="text-muted">8:40 PM</small>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                </div>
            </div>
        </div>
    </div>
</div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.themekita.com">
                                ThemeKita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Help
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright ml-auto">
                    2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
                </div>				
            </div>
        </footer>    
@endsection

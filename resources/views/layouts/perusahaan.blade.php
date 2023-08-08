<!DOCTYPE html>
<html lang="id">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>DIGIJOB-UGIPORT</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="/gambar/icon.ico" type="image/x-icon"/>
        <!-- Fonts and icons -->
        <script src="/Atlantis/examples/assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: {"families":["Lato:300,400,700,900"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/Atlantis/examples/assets/css/fonts.min.css']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @livewireStyles
        <!-- CSS Files -->
        <link rel="stylesheet" href="/Atlantis/examples/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Atlantis/examples/assets/css/atlantis.min.css">
        <style>
            .bold{
                font-size: 11px;
                text-transform: uppercase;
                font-weight: bold;
                line-height:1px;
            }
            .cicrlegreen{
                height: 15px;
                width: 15px;
                border-radius: 50%;
                background-color: green;
                display: inline-block;
            }
            .cicrlered{
                height: 15px;
                width: 15px;
                border-radius: 50%;
                background-color: red;
                display: inline-block;
            }
            .text1 {
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
            }
            body{
                background-color:#9BE8D8;
            }
            .img{
                width: 100%;
                height: auto;
                border: 1px solid black;
                border-radius: 2%;
            }
            .img2 {
                width: 100%;
                height: auto;
            }
            video {
                width: 100%;
                height: auto;
            }
            #jeda {
                display: none;
            }
            #play {
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="main-header">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="green">

                    <a href="/" class="logo">
                        <b class="" style="color: white">DIGIJOB-UGIPORT</b>
                    </a>
                    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="icon-menu"></i>
                        </span>
                    </button>
                    <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="icon-menu"></i>
                        </button>
                    </div>
                </div>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-expand-lg" data-background-color="green2">

                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                                    <li>
                                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                                            Pesan
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                @foreach ($pesan as $item)
                                                    <a href="/perusahaan/kirim_balik/{{$item->id}}">
                                                        <div class="notif-content">
                                                            <span class="subject">{{$item->pengirim}}</span>
                                                            <span class="block">
                                                                {{$item->pesan}}
                                                            </span>
                                                            <span class="time">{{date('d-M-Y | H:m',strtotime($item->created_at))}}</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="/perusahaan/semua_pesan">Lihat Semua Pesan<i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    @php
                                        $ttl_notif = $notif->count();
                                    @endphp
                                    <span class="notification" style="background-color: red;">{{$ttl_notif}}</span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">Notifikasi</div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                @foreach ($notif as $item)
                                                    <a href="{{$item->url}}">
                                                        <div class="row">
                                                            <div class="col-2 mr-1">
                                                                <div class="notif-icon notif-warning"> 
                                                                    <i class="fa fa-bell"></i> 
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="notif-content">
                                                                    <div class="text1" style="">{{$item->isi}}</div>
                                                                    <span class="time">{{date('d-M-Y | H:m',strtotime($item->created_at))}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>    
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="/perusahaan/semua_notif">Lihat Semua Notifikasi<i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class=""></i>Credit
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">Credit</div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                @if ($credit->credit == null)
                                                    <div class="ml-2 my-3">Credit Anda : 0</div>                                                    
                                                @else
                                                    <div class="ml-2 my-3">Credit Anda : {{$credit->credit}}</div>                                                    
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        @if ($perusahaan->logo_perusahaan !== null)
                                            <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Logo Perusahaan/{{$perusahaan->logo_perusahaan}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">
                                        @else
                                            <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                                                                        
                                        @endif
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    @if ($perusahaan->logo_perusahaan !== null)
                                                       <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Logo Perusahaan/{{$perusahaan->logo_perusahaan}}" alt="image profile" class="avatar-img rounded"> 
                                                    @else
                                                        <img src="/gambar/default_user.png" alt="image profile" class="avatar-img rounded">
                                                    @endif
                                                </div>                                                        
                                                <div class="u-text">
                                                    <h4>{{$perusahaan->nama_perusahaan}}</h4>
                                                    <p class="text-muted">{{$perusahaan->email_perusahaan}}</p>
                                                    @if (auth()->user()->verify_confirmed !== null)
                                                        <span class="badge badge-pill badge-info">Verified</span>
                                                    @endif
                                                    @if ($perusahaan->email_operator !== null)
                                                        <span class="badge badge-pill badge-success">Profile</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/perusahaan/lihat/perusahaan">Profil</a>
                                            @if ($perusahaan->email_operator == null)
                                                <a class="dropdown-item" href="/perusahaan/isi_perusahaan_data">Lengkapi Profil</a>
                                            @else
                                                <a class="dropdown-item" href="/perusahaan/isi_perusahaan_data">Edit Profil</a>
                                            @endif
                                            {{-- <a class="dropdown-item" href="#">Kotak Masuk</a> --}}
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/contact_us_perusahaan">Contact Us</a>
                                            <div class="dropdown-divider"></div>
                                            @if ($perusahaan->email_operator !== null)
                                                <li>
                                                    <a href="/perusahaan/tambah/cabang_data" class="dropdown-item">
                                                        <div class="link-collapse">Tambah Cabang <i class="fas fa-user-circle float-right"></i></div>
                                                    </a>
                                                </li>
                                                <div class="dropdown-divider"></div>
                                                <li>
                                                    @foreach ($cabang as $item)
                                                        <a href="/perusahaan/ganti/cabang_perusahaan/{{$item->id_perusahaan_cabang}}" class="dropdown-item">
                                                            <div class="link-collapse">
                                                                <b class="bold">
                                                                    {{$item->nama_perusahaan}} <span class="badge badge-pill badge-primary">{{$item->penempatan_kerja}}</span>
                                                                </b>  
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </li>
                                            @endif
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('logout')}}" class="dropdown-item" onclick="confirmation(event)">Keluar</a>
                                            {{-- <a class="dropdown-item" onclick="return confirm('apakah anda yakin ingin keluar?')" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                Keluar
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="get" class="d-none">
                                                @csrf
                                            </form> --}}
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <!-- Sidebar -->
            <div class="sidebar sidebar-style-2">
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        {{-- <div class="user">
                            <div class="avatar-sm float-left mr-2">
                                @if ($perusahaan->logo_perusahaan !== null)
                                    <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Logo Perusahaan/{{$perusahaan->logo_perusahaan}}" alt="" class="avatar-img rounded-circle">                                    
                                @else
                                    <img src="/gambar/default_user.png" alt="" class="avatar-img rounded-circle">
                                @endif
                            </div>
                            <div class="info">
                                <a data-toggle="collapse" class="btn" href="#collapseExample" aria-expanded="true">
                                    <span>
                                        <span class="text1" style="text-transform: uppercase;"><b class="bold">{{$perusahaan->nama_perusahaan}}</b></span>
                                        <span class="caret"></span>
                                    </span>
                                </a>
                                <div class="clearfix"></div>
                                <div class="collapse in" id="collapseExample">
                                    <ul class="nav">
                                        <li>
                                            <a href="/perusahaan/lihat/perusahaan" class="dropdown-item">
                                                <div class="link-collapse">Profil Perusahaan <i class="fas fa-user-circle float-right"></i></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/perusahaan/isi_perusahaan_data" class="dropdown-item">
                                                @if ($perusahaan->email_operator == null)
                                                    <div class="link-collapse"> Lengkapi Profil<i class="fas fa-exclamation-circle float-right"></i></div>
                                                @else
                                                    <div class="link-collapse"> Edit Profil <i class="fas fa-edit float-right"></i></div>
                                                @endif
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('logout')}}" class="dropdown-item" onclick="confirmation(event)">
                                                <div class="link-collapse">Keluar <i class="fas fa-door-open float-right"></i></div>
                                            </a>
                                        </li>
                                        <hr>
                                        @if ($perusahaan->email_operator !== null)
                                            <li>
                                                <a href="/perusahaan/tambah/cabang_data" class="dropdown-item">
                                                    <div class="link-collapse">Tambah Cabang <i class="fas fa-user-circle float-right"></i></div>
                                                </a>
                                            </li>
                                            <li>
                                                @foreach ($cabang as $item)
                                                    <a href="/perusahaan/ganti/cabang_perusahaan/{{$item->id_perusahaan_cabang}}" class="dropdown-item">
                                                        <div class="link-collapse">
                                                            <b class="bold">
                                                                {{$item->nama_perusahaan}} <span class="badge badge-pill badge-primary">{{$item->penempatan_kerja}}</span>
                                                            </b>  
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <ul class="nav nav-primary">
                            <li class="nav-item active">
                                <a href="/perusahaan" class="btn" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <p>Beranda</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            <div class="main-panel">
                <div class="content">
                    <main class="px-1">
                        @yield('content')
                    </main>
                    <footer class="footer" style="background-color: #2bb930">
                        <div class="container-fluid">
                            <nav class="pull-left">
                                <ul class="nav nav-primary">
                                    <li class="nav-item">
                                        <div class="copyright" style="color:white;">
                                            &copy; Copyright <strong><span>DIGIJOB-UGIPORT</span></strong>. All Rights Reserved
                                        </div>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Help
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Licenses
                                        </a>
                                    </li> --}}
                                </ul>
                            </nav>
                            <div class="copyright ml-auto">
                                &nbsp;
                                {{-- 2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a> --}}
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="/Atlantis/examples/assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="/Atlantis/examples/assets/js/core/popper.min.js"></script>
        <script src="/Atlantis/examples/assets/js/core/bootstrap.min.js"></script>

        <!-- jQuery UI -->
        <script src="/Atlantis/examples/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="/Atlantis/examples/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="/Atlantis/examples/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

        <!-- Chart JS -->
        <script src="/Atlantis/examples/assets/js/plugin/chart.js/chart.min.js"></script>

        <!-- jQuery Sparkline -->
        <script src="/Atlantis/examples/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

        <!-- Chart Circle -->
        <script src="/Atlantis/examples/assets/js/plugin/chart-circle/circles.min.js"></script>

        <!-- Datatables -->
        <script src="/Atlantis/examples/assets/js/plugin/datatables/datatables.min.js"></script>

        <!-- Bootstrap Notify -->
        <script src="/Atlantis/examples/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

        <!-- jQuery Vector Maps -->
        <script src="/Atlantis/examples/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
        <script src="/Atlantis/examples/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

        <!-- Sweet Alert -->
        <script src="/Atlantis/examples/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

        <!-- Atlantis JS -->
        <script src="/Atlantis/examples/assets/js/atlantis.min.js"></script>
        
        <!-- Datatables -->
        <script >
            $(document).ready(function() {
                $('#basic-datatables').DataTable({
                });
    
                $('#multi-filter-select').DataTable( {
                    "pageLength": 5,
                    initComplete: function () {
                        this.api().columns().every( function () {
                            var column = this;
                            var select = $('<select class="form-control"><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                    );
    
                                column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                            } );
    
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                    }
                });
    
                // Add Row
                $('#add-row').DataTable({
                    "pageLength": 5,
                });
    
                var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';
    
                $('#addRowButton').click(function() {
                    $('#add-row').dataTable().fnAddData([
                        $("#addName").val(),
                        $("#addPosition").val(),
                        $("#addOffice").val(),
                        action
                        ]);
                    $('#addRowModal').modal('hide');
    
                });
            });
        </script>

        <script type="text/javascript">
            function confirmation(ev)
                {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
                console.log(url);
                swal({
                    title: 'Apakah anda yakin ingin keluar?',
                    type: 'warning',
                    icon: 'warning',
                    buttons:{
                        confirm: {
                            text : 'Iya',
                            className : 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            text: 'Tidak',
                            className: 'btn btn-danger'
                        }
                    }
                }).then((Delete) => {
                    if (Delete) {
                        window.location.href = url;
                    } else {
                        swal.close();
                    }
                });    
            }

            function hapusData(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
                console.log(url);
                swal({
                    title: 'Apakah anda yakin ingin menghapus data ini?',
                    type: 'warning',
                    icon: 'warning',
                    buttons:{
                        confirm: {
                            text : 'Iya',
                            className : 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            className: 'btn btn-danger'
                        }
                    }
                }).then((Delete) => {
                    if (Delete) {
                        window.location.href = url;
                    } else {
                        swal.close();
                    }
                });
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('change','#negara_tujuan', function() {
                    var negara = $(this).val();
                    var sp1 = document.getElementById("mata_uang1");
                    var sp2 = document.getElementById("mata_uang2");
                    var div = $(this).parent();
                    console.log(negara);
                    $.ajax({
                        type:'get',
                        url:'{!!URL::to('/lowongan_negara')!!}',
                        data:{'negara':negara},
                        success:function(data){
                            console.log(data.mata_uang);
                            sp1.textContent = data.mata_uang;
                            sp2.textContent = data.mata_uang;
                        }
                    })
                })
            })
        </script>
        <script>
            var video = document.getElementById("video");
            var btnPlay = document.getElementById('play');
            var btnJeda = document.getElementById('jeda');
            function play() {
                if (video.paused) {
                video.play();
                btnJeda.style.display = 'block';
                btnPlay.style.display = 'none';
                }
            }

            function pause() {
                if (video.play) {
                video.pause();
                btnPlay.style.display = 'block';
                btnJeda.style.display = 'none';
                }
            }
        </script>
        @livewireScripts
    </body>
</html>

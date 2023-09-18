<!DOCTYPE html>
<html lang="id">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>DIGIJOB</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="/Atlantis/examples/assets/img/icon.ico" type="image/x-icon"/>
        
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

        <!-- CSS Files -->
        <link rel="stylesheet" href="/Atlantis/examples/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Atlantis/examples/assets/css/atlantis.min.css">
        <link rel="stylesheet" href="/css/loader.css">
        <style>
            .bold{
                font-size: 11px;
                text-transform: uppercase;
                font-weight: bold;
                line-height:1px;
            }
            .img{
                border: 1px solid black;
                border-radius: 2%;
            }
            .text1{
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
            }
            body{
                background-color: #FAE392;
            }
        </style>
    </head>
    <body onload="loadingPage()">
        <div class="wrapper">
            <div class="main-header">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="orange">
                    <a href="/" class="logo" style="background-color: transparent;">
                        <b class="" style="color: white">DIGIJOB</b>
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
                <nav class="navbar navbar-header navbar-expand-lg" data-background-color="orange2">

                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                            <li class="nav-item dropdown hidden-caret">
                                <a class="" style="color: white; background-color:transparent;" href="/akademi/semua_pesan">
                                    <i class="fa fa-envelope" style="font-size:23px; background-color:transparent;"></i>
                                    @php
                                        $ttl_pesan = $pesan->count();
                                    @endphp
                                    @if ($ttl_pesan !== 0)
                                        <span style="background-color: red; width:12px; height:12px; border-radius:50%; display:inline-block; margin-left:-9px;"></span>                                        
                                    @endif
                                </a>
                                {{-- <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                                    <li>
                                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                                            Pesan
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                @foreach ($pesan as $item)
                                                    <a href="">
                                                        <div class="notif-content">
                                                            <span class="subject">{{$item->pengirim}}</span>
                                                            <span class="block">
                                                                {{$item->pesan}}
                                                            </span>
                                                            <span class="time">{{date('d-m-Y | h:m:sa',strtotime($item->created_at))}}</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="/akademi/semua_pesan">Lihat Semua Pesan<i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul> --}}
                            </li>
                            {{-- <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="/perbaikan" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">Ada Notifikasi Baru</div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                @foreach ($notif as $item)
                                                    <a href="{{$item->url}}">
                                                        <div class="row">
                                                            <div class="col-2 mr-1">
                                                                <div class="notif-icon notif-warning"> 
                                                                    <i class="fas fa-bell"></i> 
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="notif-content">
                                                                    <div class="text1" style="">{{$item->isi}}</div>
                                                                    <span class="time">{{date('d-m-Y | h:m:sa',strtotime($item->created_at))}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>    
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="/akademi/semua_notif">Lihat Semua Notifikasi<i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </li> --}}
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false" style="background-color: transparent;">
                                    <div class="avatar-sm">
                                        @if ($akademi->logo_akademi !== null)
                                            <img src="/gambar/Akademi/{{$akademi->nama_akademi}}/Logo Akademi/{{$akademi->logo_akademi}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">
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
                                                    @if ($akademi->logo_akademi !== null)
                                                        <img src="/gambar/Akademi/{{$akademi->nama_akademi}}/Logo Akademi/{{$akademi->logo_akademi}}" alt="image profile" class="avatar-img rounded">
                                                    @else
                                                        <img src="/gambar/default_user.png" alt="image profile" class="avatar-img rounded">                                                        
                                                    @endif
                                                </div>
                                                <div class="u-text">
                                                    <b class="bold">{{$akademi->nama_akademi}}</b>
                                                    <p class="text-muted">{{$akademi->email}}</p>
                                                @if (auth()->user()->verify_confirmed !== null)
                                                    <span class="badge badge-pill badge-info">Terverifikasi</span>
                                                @endif
                                                @if ($akademi->no_telp_operator !== null)
                                                    <span class="badge badge-pill badge-success">Profil</span>
                                                @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/akademi/lihat/profil">Profil Akademi</a>
                                            @if ($akademi->no_telp_operator == null)
                                                <a class="dropdown-item" href="/akademi/isi_akademi_data">Lengkapi Profil</a>
                                            @else
                                                <a class="dropdown-item" href="/akademi/isi_akademi_data">Edit Profil</a>
                                            @endif
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('logout')}}" class="dropdown-item" onclick="confirmation(event)">Keluar</a>
                                            <div class="dropdown-divider"></div>
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
            @php
                $data = $akademi->logo_akademi;
                $operator = $akademi->no_telp_operator;
            @endphp
            <div class="sidebar sidebar-style-2">
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <ul class="nav nav-primary">
                            <li class="nav-item active">
                                <a href="/akademi" class="btn" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <p></p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Komponen</h4>
                            </li>
                            @if ($data == null)
                                <li class="nav-item">
                                    <a class="btn" href="/akademi/list_kandidat">
                                        <i class="fas fa-layer-group"></i>
                                        <p>Lengkapi Data Akademi</p>
                                    </a>
                                </li>    
                            @elseif($operator == null)
                                <li class="nav-item">
                                    <a class="btn" href="/akademi/list_kandidat">
                                        <i class="fas fa-layer-group"></i>
                                        <p>Lengkapi Data Operator</p>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="btn" href="/akademi/list_kandidat">
                                        <i class="fas fa-layer-group"></i>
                                        <p>Data Kandidat</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->
            <div class="loading align">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            </div>
            <div class="main-panel">
                <div class="content">
                    <main class="px-3">
                        @yield('content')
                    </main>
                </div>
                <footer class="footer" style="background-color: #ff9e27">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul class="nav nav-primary">
                                <li class="nav-item">
                                    <div class="copyright" style="color:white;">
                                        &copy; Copyright <strong><span>DIGIJOB-UGIPORT</span></strong>. All Rights Reserved
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <div class="copyright ml-auto">
                            &nbsp;
                            <strong><a class="" href="/contact_us_akademi" style="color: white; background-color:transparent; text-decoration:none; text-transform:uppercase;">Hubungi Kami</a></strong>
                        </div>
                    </div>
                </footer>
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
        <script>
            // fungsi tabel
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
        <!-- fungsi sistem loading -->
        <script src="/js/loader.js"></script>
        <script type="text/javascript">
            // alert konfirmasi keluar / log out
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
        </script>
    </body>
</html>

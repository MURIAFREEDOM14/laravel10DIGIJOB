<!DOCTYPE html>
<html lang="id">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>DIGIJOB-UGIPORT</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="/gambar/icon.ico" type="image/x-icon"/>
        <style>
            .bold{
                font-size: 11px;
                text-transform: uppercase;
                font-weight: bold;
                line-height:1px;
            }
            .word{
                text-transform: uppercase;
                font-weight: bold;
                line-height:1px;
            }
            .img{
                width: 100%;
                height: auto;
                border: 1px solid black;
                border-radius: 2%;
            }
            .img2{
                width: 100%;
                height: auto;
            }
            .hidden{
                display:none;
            }
            video{
                width: 100%;
                height: auto;
            }
            .text1 {
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
            }
            #hidetext{
                display: none;
            }
            #negara_tujuan{
                display: none;
            }
            #hidebtn{
                display: none;
            }
            #jeda {
                display: none;
            }
            #play {
                display: block;
            }
        </style>
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
        
        @livewireStyles
    </head>
    <body>
        <div class="wrapper">
            <div class="main-header">
                <!-- Logo Header -->
                <div class="logo-header" style="background-image:linear-gradient(150deg,red,lightgreen,blue);">

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
                <nav class="navbar navbar-header navbar-expand-lg" style="background-image:linear-gradient(150deg,red,lightgreen,blue);">

                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                            <li class="nav-item dropdown hidden-caret">
                                {{-- <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a> --}}
                                <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                                    <li>
                                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                                            Pesan
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="">
                                                    <div class="notif-img">
                                                        <img src="/Atlantis/examples/assets/img/jm_denis.jpg" alt="Img Profile">
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jimmy Denis</span>
                                                        <span class="block">
                                                            How are you ?
                                                        </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="/semua_pesan">Lihat Semua Pesan<i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hidden-caret">
                                {{-- <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification">4</span>
                                </a> --}}
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">Ada Notifikasi Baru</div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            New user registered
                                                        </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="/semua_notif">Lihat Semua Notifikasi<i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                        <img src="/gambar/default_user.png" alt="image profile" class="avatar-img rounded"></div>                                                        
                                                <div class="u-text">
                                                    <h4>{{$manager->name}}</h4>
                                                    <p class="text-muted">{{$manager->email}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('logout')}}" class="dropdown-item" onclick="confirmation(event)">Keluar</a>
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
                        <ul class="nav nav-primary">
                            <li class="nav-item active">
                                <a href="/" class="btn" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Komponen</h4>
                            </li>
                            <li class="nav-item">
                                <a class="btn" data-toggle="collapse" href="#kandidat">
                                    <i class="fas fa-layer-group"></i>
                                    <p>Data Kandidat</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="kandidat">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a class="btn" href="/manager/kandidat/kandidat_baru">
                                                <span class="sub-item">Kandidat Baru</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/kandidat/dalam_negeri">
                                                <span class="sub-item">Dalam Negeri</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/kandidat/luar_negeri">
                                                <span class="sub-item">Luar Negeri</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/negara_tujuan">
                                                <span class="sub-item">Negara Tujuan</span>
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <a class="btn" href="/manager/pekerjaan">
                                                <span class="sub-item">Data Pekerjaan</span>
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a class="btn" href="/manager/surat_izin">
                                                <span class="sub-item">Surat izin</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/kandidat/pelatihan">
                                                <span class="sub-item">Video Pelatihan</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/kandidat/pelamar_lowongan">
                                                <span class="sub-item">Pelamar Lowongan</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/kandidat/penolakan_kandidat">
                                                <span class="sub-item">Penolakan Kandidat</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/kandidat/penghapusan_kandidat">
                                                <span class="sub-item">Penghapusan Kandidat</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/kandidat/laporan_kandidat">
                                                <span class="sub-item">Laporan Kerja Kandidat</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn" data-toggle="collapse" href="#akademi">
                                    <i class="fas fa-th-list"></i>
                                    <p>Data Akademi</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="akademi">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="/manager/akademi/list_akademi">
                                                <span class="sub-item">List Akademi</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn" data-toggle="collapse" href="#perusahaan">
                                    <i class="fas fa-th-list"></i>
                                    <p>Data Perusahaan</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="perusahaan">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a class="btn" href="/manager/perusahaan/list_perusahaan">
                                                <span class="sub-item">List Perusahaan</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/perusahaan/pembuatan_id_pmi">
                                                <span class="sub-item">Pembuatan PMI ID</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn" data-toggle="collapse" href="#pembayaran">
                                    <i class="fas fa-layer-group"></i>
                                    <p>Data Pembayaran</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="pembayaran">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a class="btn" href="/manager/pembayaran/kandidat">
                                                <span class="sub-item">Kandidat</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="btn" href="/manager/pembayaran/perusahaan">
                                                <span class="sub-item">Perusahaan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn" href="/manager/search_email">
                                    <i class="fas fa-th-list"></i>
                                    <p>Verifikasi Email</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn" href="/manager/contact_us_admin">
                                    <i class="fas fa-th-list"></i>
                                    <p>Contact Us</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            <div class="main-panel">
                <div class="content">
                    <main class="">
                        @include('sweetalert::alert')
                        @include('flash_message')
                        @yield('content')
                    </main>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul class="nav">
                                <li class="nav-item">
                                    <div class="copyright" style="color:white;">
                                        &copy; Copyright <strong><span>DIGIJOB-UGIPORT</span></strong>. All Rights Reserved
                                    </div>
                                </li>
                                {{-- <li class="nav-item">
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

        <!-- datatable -->
        <script type="https://code.highcharts.com/highcharts.js"></script>
        <script type="text/javascript">
            
        </script>
        <script>
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
                    title: 'Apakah anda yakin ingin Menghapus data ini?',
                    type: 'warning',
                    icon: 'warning',
                    buttons:{
                        confirm: {
                            text : 'Iya',
                            className : 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            text:'tidak',
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

            function hapusNegara(ev)
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
        <script>
            var multipleBarChart = document.getElementById('multipleBarChart').getContext('2d');
            var myMultipleBarChart = new Chart(multipleBarChart, {
                type: 'bar',
                data: {
                    labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
                    datasets : [{
                        label: "Kandidat",
                        backgroundColor: '#177dff',
                        borderColor: '#177dff',
                        data: [50, 100, 112, 101, 144, 159, 178],
                    },{
                        label: "Akademi",
                        backgroundColor: '#fdaf4b',
                        borderColor: '#fdaf4b',
                        data: [145, 256, 244, 233, 210, 279, 287],
                    }, {
                        label: "Perusahaan",
                        backgroundColor: '#59d05d',
                        borderColor: '#59d05d',
                        data: [185, 279, 273, 287, 234, 312, 322],
                    }],
                },
                options: {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position : 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Pengguna'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
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

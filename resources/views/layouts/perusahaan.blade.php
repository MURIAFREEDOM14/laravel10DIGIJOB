<!DOCTYPE html>
<html lang="id">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>DIGIJOB</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <!-- gambar icon tab browser -->
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
        <!-- sistem AJAX -->
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
                border-radius: 50%;
            }
            #judulJenisPekerja {
                display: none;
            }
            #namaJenisPekerja {
                display: none;
            }
            #btnJenisPekerja {
                display: none;
            }
            video {
                width: 100%;
                height: auto;
            }
            #scrollInterview {
                overflow: auto;
                width: 100%;
                height: auto;
            }
            #jeda {
                display: none;
            }
            #play {
                display: block;
            }
            #tambahFasilitas {
                display: block;
            }
            #fasilitasTambah {
                display: none;
            }
            #tambahBenefit {
                display: block;
            }
            #benefitTambah {
                display: none;
            }
            #random {
                display: none;
            }
        </style>
        @livewireStyles
    </head>
    <body onload="loadingPage()">
        <div class="wrapper">
            <div class="main-header">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="green">
                    <a href="/" class="logo" style="background-color: #31ce36">
                        <b class="" style="color: white;">DIGIJOB</b>
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
                                <a class="" href="/perusahaan/semua_pesan" style="color: white; background-color:#2bb930;">
                                    <i class="fa fa-envelope" style="font-size: 23px; background-color:#2bb930;"></i>
                                    @php
                                        $ttl_pesan = $pesan->count();
                                    @endphp
                                    @if ($ttl_pesan !== 0)
                                        <span style="background-color: red; width:12px; height:12px; border-radius:50%; display:inline-block; margin-left:-9px"></span>
                                    @endif
                                </a>
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
                                                    <div class="ml-2 my-3" style="text-transform: uppercase;">Credit Anda : 0</div>
                                                    <div class="dropdown-divider"></div>
                                                    <div style="font-size: 13px;" class="mx-2 my-3">Credit ini dapat anda gunakan saat anda melakukan interview</div>
                                                @else
                                                    <div class="ml-2 my-3" style="text-transform: uppercase;">Credit Anda : {{$credit->credit}}</div>
                                                    <div class="dropdown-divider"></div>
                                                    <div style="font-size: 13px;" class="mx-2 my-3">Credit ini dapat anda gunakan saat anda melakukan interview</div>
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
                                                        <span class="badge badge-pill badge-info">Terverifikasi</span>
                                                    @endif
                                                    @if ($perusahaan->email_operator !== null)
                                                        <span class="badge badge-pill badge-success">Profil</span>
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
                                            {{-- @if ($perusahaan->email_operator !== null)
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
                                            @endif --}}
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
                                <a href="/perusahaan" class="btn" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <p></p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Menu</h4>
                            </li>
                            @php
                                // sistem penyeleksian data inputan
                                // dari isi perusahaan data
                                $data = $perusahaan->logo_perusahaan;
                                // dari isi perusahaan alamat
                                $alamat = $perusahaan->no_telp_perusahaan;
                                // dari isi perusahaan operator
                                $operator = $perusahaan->email_operator;
                            @endphp
                            @if ($data == null)
                                <li class="nav-item">
                                    <a href="/perusahaan/isi_perusahaan_data">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Harap lengkapi data anda</p>
                                    </a>
                                </li>
                            @elseif($alamat == null)
                                <li class="nav-item">
                                    <a href="/perusahaan/isi_perusahaan_alamat">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Harap lengkapi data anda</p>
                                    </a>
                                </li>
                            @elseif($operator == null)
                                <li class="nav-item">
                                    <a href="/perusahaan/isi_perusahaan_operator">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Harap lengkapi data anda</p>
                                    </a>    
                                </li>
                            @else
                                <li class="nav-item">
                                    <a data-toggle="collapse" href="#forms">
                                        <i class="fas fa-flag"></i>
                                        <p>Lowongan Pekerjaan</p>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="forms">
                                        <ul class="nav nav-collapse">
                                            <li class="nav-section">
                                                <h4 class="text-section">Buat Lowongan Baru</h4>
                                            </li>
                                            @if ($perusahaan->penempatan_kerja == "Luar negeri")
                                                <a href="/perusahaan/list/lowongan/{{"dalam"}}">
                                                    <li class="nav-item">
                                                        <i class="fas fa-pen-square"></i>
                                                        <p>Dalam Negeri</p>
                                                    </li>
                                                </a>    
                                                <a href="/perusahaan/list/lowongan/{{"luar"}}">
                                                    <li class="nav-item">
                                                        <i class="fas fa-pen-square"></i>
                                                        <p>Luar Negeri</p>
                                                    </li>
                                                </a>
                                            @elseif($perusahaan->penempatan_kerja == "Dalam negeri")
                                                <a href="/perusahaan/list/lowongan/{{"dalam"}}">
                                                    <li class="nav-item">
                                                        <i class="fas fa-pen-square"></i>
                                                        <p>Dalam Negeri</p>
                                                    </li>
                                                </a>    
                                            @endif
                                            <li class="nav-section">
                                                <h4 class="text-section">List Lowongan</h4>
                                            </li>
                                            <a href="/perusahaan/list_permohonan_lowongan">
                                                <li class="nav-item">
                                                    <i class="fas fa-pen-square"></i>
                                                    <p>List Lowongan</p>
                                                </li>
                                            </a>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="/perusahaan/semua/kandidat">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Data kandidat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/perusahaan/list/pembayaran">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Data Pembayaran</p>
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
                    <main class="px-1">
                        @yield('content')
                    </main>
                </div>
                <!-- pembatas antara body dengan footer -->
                <footer class="footer" style="background-color: #2bb930;">
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
                            <strong><a class="" style="color: white; background-color:#2bb930; text-decoration:none;" href="/perusahaan/contact_us_perusahaan" style="text-transform: uppercase">Hubungi Kami</a></strong>
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
        <script src="/js/loader.js"></script>
        <script type="text/javascript">
            // alert konfirmasi keluar / log out
            function confirmation(ev)
                {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
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

            // alert konfirmasi hapus data
            function hapusData(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
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

            // alert konfirmasi keluarkan kandidat
            function keluarkanKandidat(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
                swal({
                    title: 'Apakah anda yakin ingin mengeluarkan kandidat ini?',
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

            // alert konfirmasi penolakan perusahaan
            function tolakData(ev) {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
                swal({
                    title: 'Apakah anda yakin ingin menolak?',
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
            // fungsi tampilan pilihan mata uang lowongan //
            $(document).ready(function() {
                $(document).on('change','#negara_tujuan', function() {
                    var negara = $(this).val();
                    var sp1 = document.getElementById("mata_uang1");
                    var sp2 = document.getElementById("mata_uang2");
                    var div = $(this).parent();
                    $.ajax({
                        type:'get',
                        url:'{!!URL::to('/lowongan_negara')!!}',
                        data:{'negara':negara},
                        success:function(data){
                            sp1.textContent = data.mata_uang;
                            sp2.textContent = data.mata_uang;
                        }
                    })
                })
            })
        </script>
        <script>
            //fungsi tampilan mulai video //
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

            // fungsi tampilan jeda video
            function pause() {
                if (video.play) {
                video.pause();
                btnPlay.style.display = 'block';
                btnJeda.style.display = 'none';
                }
            }

            // fungsi tampilan tambah benefit lowongan //
            function btnTambahBenefit() {
                var tambah = document.getElementById('tambahBenefit');
                var benefit = document.getElementById('benefitTambah');
                benefit.style.display = 'block';
                tambah.style.display = 'none';
            }

            // fungsi tampilan pembatalan benefit lowongan
            function batalBenefit() {
                var tambah = document.getElementById('tambahBenefit');
                var benefit = document.getElementById('benefitTambah');
                benefit.style.display = 'none';
                tambah.style.display = 'block';
            }

            // fungsi AJAX pengiriman data benefit
            function opsiBenefit() {
                var input = document.getElementById('inputBenefit').value;
                var tambah = document.getElementById('tambahBenefit');
                var benefit = document.getElementById('benefitTambah');
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('/benefit')!!}',
                    data:{'data':input},
                    success:function (data) {
                        benefit.style.display = 'none';
                        tambah.style.display = 'block';
                        location.reload();
                    }
                })
            }
             // fungsi tampilan tambah fasilitas lowongan //
            function btnTambahFasilitas() {
                var tambah = document.getElementById('tambahFasilitas');
                var fasilitas = document.getElementById('fasilitasTambah');
                fasilitas.style.display = 'block';
                tambah.style.display = 'none';
            }

            // fungsi tampilan pembatalan fasilitas lowongan
            function batalFasilitas() {
                var tambah = document.getElementById('tambahFasilitas');
                var fasilitas = document.getElementById('fasilitasTambah');
                fasilitas.style.display = 'none';
                tambah.style.display = 'block';
            }

            // fungsi AJAX pengiriman data fasilitas
            function opsiFasilitas() {
                var input = document.getElementById('inputFasilitas').value;
                var tambah = document.getElementById('tambahFasilitas');
                var fasilitas = document.getElementById('fasilitasTambah');
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('/fasilitas')!!}',
                    data:{'data':input},
                    success:function (data) {
                        fasilitas.style.display = 'none';
                        tambah.style.display = 'block';
                        location.reload();
                    }
                })
            }

            // fungsi tampilan pilihan usia lowongan //
            $(document).ready(function() {
                $(document).on('change','#ideal', function() {
                    var ideal = this.value;
                    var btnUsia = document.getElementById('ideal').value;
                    var custom = document.getElementById('random');
                    if (btnUsia === 'kustom') {
                        custom.style.display = 'block';
                    } else {
                        custom.style.display = 'none';
                    }
                })
            })
            
            // fungsi menambah opsi tambahan jenis pekerja
            $(document).ready(function() {
                $(document).on('change','#jenisPekerjaan', function() {
                    var jenisPekerjaan = this.value;
                    var judulJenisPekerja = document.getElementById('judulJenisPekerja');
                    var namaJenisPekerja = document.getElementById('namaJenisPekerja');
                    var btnTambahOpsi = document.getElementById('btnJenisPekerja');
                    if (jenisPekerjaan == "lainnya") {
                        judulJenisPekerja.style.display = 'block';
                        namaJenisPekerja.style.display = 'block';
                        btnTambahOpsi.style.display = 'block';
                    } else {
                        judulJenisPekerja.style.display = 'none';
                        namaJenisPekerja.style.display = 'none';
                        btnTambahOpsi.style.display = 'none';
                    }
                })
            })

            // mengirimkan input jenis pekerjaan dengan AJAX
            $('#btnJenisPekerja').on('click', function() {
                var judulJenisPekerja = document.getElementById('judulJenisPekerja');
                var namaJenisPekerja = document.getElementById('namaJenisPekerja');
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('/jenis_pekerja')!!}',
                    data:{'judul':judulJenisPekerja.value, 'nama':namaJenisPekerja.value},
                    success:function (data) {
                        $("#jenisPekerjaan").append("<option value='"+ judulJenisPekerja.value +"' selected>" + judulJenisPekerja.value + "</option>")
                        document.getElementById('btnJenisPekerja').style.display = 'none';
                        judulJenisPekerja.style.display = 'none';
                        namaJenisPekerja.style.display = 'none';
                    }
                })
            })
        </script>
        @livewireScripts
    </body>
</html>

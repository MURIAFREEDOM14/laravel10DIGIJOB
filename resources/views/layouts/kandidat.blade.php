<!DOCTYPE html>
<html lang="id">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>DIGIJOB-UGIPORT</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="icon" href="/gambar/icon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="/moving.css">
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
        <script src="/js/captcha.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="/Atlantis/examples/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Atlantis/examples/assets/css/atlantis.min.css">
        <link rel="stylesheet" href="/cardSlide/style.css">
        <link rel="stylesheet" href="/captcha.css">    
        
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
            body{
                background-color:#78C1F3;
            }
            #batalInterview{
                display: none;
            }
            #terimaInterview{
                display: block;
            }
            #bekerja {
                display: none;
            }
            #alasan {
                display: none;
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
                <div class="logo-header" data-background-color="blue2">
                    <a href="/" class="logo">
                        <b class="" style="color: white">DIGIJOB-UGIPORT</b>
                    </a>
                    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="icon-menu"></i>
                        </span>
                    </button>
                    <button class="topbar-toggler more">
                        <i class="icon-options-vertical"></i></button>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="icon-menu"></i>
                        </button>
                    </div>
                </div>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="/perbaikan" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope" style="color:white"></i>
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
                                                    <a href="/kirim_balik/{{$item->id}}">
                                                        <div class="notif-content">
                                                            <span class="subject">{{$item->pengirim}}</span>
                                                            <span class="block">
                                                                {{$item->pesan}}
                                                            </span>
                                                            <span class="time">{{date('d-M-Y | h:m',strtotime($item->created_at))}}</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="/semua_pesan">Lihat Semua Pesan<i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    @php
                                        $ttl_notif = $notif->count();
                                    @endphp
                                    @if ($ttl_notif !== 0)
                                        <span class="notification" style="background-color: red">{{$ttl_notif}}</span>                                        
                                    @endif
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
                                        <a class="see-all" href="/semua_notif">Lihat Semua Notifikasi<i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        @if ($kandidat->foto_4x6 !== null)
                                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">
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
                                                    @if ($kandidat->foto_4x6 !== null)
                                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" alt="image profile" class="avatar-img rounded">
                                                    @else
                                                        <img src="/gambar/default_user.png" alt="image profile" class="avatar-img rounded">                                                        
                                                    @endif
                                                </div>
                                                <div class="u-text">
                                                    <b class="bold">{{$kandidat->nama}}</b>
                                                    <p class="text-muted">{{$kandidat->email}}</p>
                                                    @if (auth()->user()->verify_confirmed !== null)
                                                        <span class="badge badge-pill badge-info">Verified</span>
                                                    @endif
                                                    @if ($kandidat->hubungan_perizin !== null)
                                                        <span class="badge badge-pill badge-success">Profile</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/profil_kandidat">Profilku</a>
                                            @if ($kandidat->hubungan_perizin == null)
                                                <a class="dropdown-item" href="/isi_kandidat_personal">Lengkapi Profil</a>
                                            @else
                                                <a class="dropdown-item" href="/isi_kandidat_personal">Edit Profil</a>                                                
                                            @endif
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/contact_us_kandidat">Contact Us</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="confirmation(event)">keluar</a>
                                            {{-- <a class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin keluar?')" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                Keluar
                                            </a> --}}
                                            <form id="logout-form" action="{{ route('logout') }}" method="get" class="d-none">
                                                @csrf
                                            </form>
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
                                @if ($kandidat->foto_4x6 !== null)
                                    <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" alt="" class="avatar-img rounded-circle">                                    
                                @else
                                    <img src="/gambar/default_user.png" alt="" class="avatar-img rounded-circle">
                                @endif
                            </div>
                            <div class="info">
                                <a data-toggle="collapse" href="#collapseExample" class="btn" aria-expanded="true">
                                    <span>
                                        <span class="" style="text-transform: uppercase;"><b class="bold">{{$kandidat->nama_panggilan}}</b></span>
                                        <span class="caret"></span>
                                    </span>
                                </a>
                                <div class="clearfix"></div>
                                <div class="collapse in" id="collapseExample">
                                    <ul class="nav">
                                        <li>
                                            <a href="/profil_kandidat" class="dropdown-item">
                                                <div class="link-collapse">Profilku <i class="fas fa-user-circle float-right"></i> </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/isi_kandidat_personal" class="dropdown-item">
                                                @if ($kandidat->hubungan_perizin == null)
                                                    <div class="link-collapse"> Lengkapi Profil <i class="fas fa-exclamation-circle float-right"></i></div>
                                                @else
                                                    <div class="link-collapse"> Edit Profil <i class="fas fa-edit float-right"></i></div>
                                                @endif
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('logout')}}" onclick="confirmation(event)" class="dropdown-item">
                                                <div class="link-collapse"> Keluar <i class="fas fa-door-open float-right"></i></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <ul class="nav nav-primary">
                            <li class="nav-item active">
                                <a href="/kandidat" class="btn" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <p style="text-transform: uppercase">beranda</p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Menu</h4>
                            </li>
                            @php
                                $personal = $kandidat->tinggi;
                                $document = $kandidat->foto_ijazah;
                                $vaksin = $kandidat->sertifikat_vaksin2;
                                $parent = $kandidat->tgl_lahir_ibu;
                                $permission = $kandidat->hubungan_perizin;                                
                            @endphp
                            @if ($personal == null)
                                <li class="nav-item">
                                    <a href="/isi_kandidat_personal">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Lengkapi Data Personal</p>
                                    </a>
                                </li> 
                            @elseif($document == null)
                            <li class="nav-item">
                                <a href="/isi_kandidat_document">
                                    <i class="fas fa-pen-square"></i>
                                    <p>Lengkapi Data Document</p>
                                </a>
                            </li>
                            @elseif($vaksin == null)
                                <li class="nav-item">
                                    <a href="/isi_kandidat_vaksin">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Lengkapi Data Vaksin</p>
                                    </a>
                                </li>
                            @elseif($parent == null)
                                <li class="nav-item">
                                    <a href="/isi_kandidat_parent">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Lengkapi Data Orang Tua / Wali</p>
                                    </a>
                                </li>
                            @elseif($permission == null)
                                <li class="nav-item">
                                    <a href="/isi_kandidat_permission">
                                        <i class="fas fa-pen-square"></i>
                                        <p>Lengkapi Data Kontak Darurat</p>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a data-toggle="collapse" href="#forms">
                                        <i class="fas fa-flag"></i>
                                        <p>Tujuan Bekerja</p>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="forms">
                                        <ul class="nav nav-collapse">
                                            <li class="nav-section">
                                                <h4 class="text-section">Tujuan Bekerja</h4>
                                            </li>
                                            <form action="/isi_kandidat_placement" method="POST">
                                                @csrf
                                                <select name="penempatan" id="placement" class="form-control">
                                                    <option value="">-- Pilih Tujuan Bekerja --</option>
                                                    <option value="dalam negeri">Dalam Negeri</option>
                                                    <option value="luar negeri">Luar Negeri</option>
                                                </select>
                                                <li class="nav-section" id="hidetext">
                                                    <h4 class="text-section">Negara Tujuan</h4>
                                                </li>
                                                <select name="negara_id" required class="form-control" id="negara_tujuan">
                                                    <option value="">-- Pilih Negara Tujuan --</option>
                                                </select>
                                                <li class="nav-section">
                                                    <button type="submit" class="btn btn-primary" id="hidebtn">Simpan</button>
                                                </li>
                                            </form>
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="btn disabled" href="/video_pelatihan">
                                    <i class="fas fa-clipboard-list"></i>
                                    {{-- <i class="fas fa-crown" style="color: yellow"></i> --}}
                                    <p>Video Pelatihan</p>
                                </a>
                            </li>
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                </span>
                            </li>
                            
                            <li class="nav-item active">
                                <a data-toggle="collapse" href="#prioritas">
                                    <i class="fas fa-crown"></i>
                                    <p style="text-transform: uppercase;">Akun Prioritas</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="prioritas">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <div class="card mx-2 bg-primary">
                                                <div class="card-body">
                                                    <div class="" style="font-weight:bold;">
                                                        Maaf fitur ini masih dalam Pembangunan.
                                                        {{-- Halo {{$kandidat->nama_panggilan}}, Kami ada penawaran menarik nih buat kamu. 
                                                        Yup yaitu Akun Prioritas,apakah kamu penasaran dengan fitur ini? 
                                                        Di fitur ini kamu akan dapat : --}}
                                                    </div>
                                                    {{-- <div class="mb-2" style="font-weight:bold;"><i class="fas fa-check-circle"></i> Dapat Video Pelatihan</div>
                                                    <div class="mb-2" style="font-weight:bold;"><i class="fas fa-check-circle"></i> Dapat Video Pelatihan</div>
                                                    <div class="mb-2" style="font-weight:bold;"><i class="fas fa-check-circle"></i> Dapat Video Pelatihan</div> --}}
                                                    {{-- <a href="/payment" class="btn btn-info" style="color:white; font-weight:bold;">Upgrade</a> --}}
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-link">
                                
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
                    <footer class="footer" style="background-color: #1269db">
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
        {{-- <script src="/cardSlide/script.js"></script> --}}

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
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('change','#placement',function() {
                    console.log("ditekan");
                    var getID = $(this).val();
                    console.log(getID);
                    var div = $(this).parent();
                    var op = "";
                    var x = document.getElementById('hidetext');
                    var y = document.getElementById('negara_tujuan');
                    var btn = document.getElementById('hidebtn');
                    if (getID == "luar negeri") {
                        $.ajax({
                            type:'get',
                            url:'{!!URL::to('/penempatan')!!}',
                            data:{'stats':getID},
                            success:function (data) {
                                console.log(data.length);
                                x.style.display = 'block';
                                y.style.display = 'block';
                                btn.style.display = 'block';
                                op+='<option value="" selected> -- Pilih Negara Tujuan -- </option>';
                                for(var i = 0; i < data.length; i++){
                                    op+='<option value="'+data[i].negara_id+'">'+data[i].negara+'</option>';
                                }
                                div.find('#negara_tujuan').html(" ");
                                div.find('#negara_tujuan').append(op);
                                console.log(op);
                            },
                            error:function() {

                            }
                        });
                    } else {
                        x.style.display = 'block';
                        y.style.display = 'block';
                        btn.style.display = 'block';
                        op+='<option value="2" selected> Indonesia </option>';
                        div.find('#negara_tujuan').html(" ");
                        div.find('#negara_tujuan').append(op);
                        console.log(op);
                    }
                })
            });

            function confirmLowongan(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
                console.log(url);
                swal({
                    title: 'Apakah anda yakin ingin Masuk lowongan ini?',
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

            function cancelLowongan(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
                console.log(url);
                swal({
                    title: 'Apakah anda yakin ingin Membatalkan lowongan ini?',
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

            function outPerusahaan(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
                console.log(url);
                swal({
                    title: 'Apakah anda yakin ingin Keluar dari perusahaan ini?',
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
            $(window).on('load',function() {
            $('#staticBackdrop').modal('show');                                                   
            });

            function tidakInterview() {
                var y = document.getElementById("terimaInterview");
                var n = document.getElementById("batalInterview");
                if (n.style.display == 'block') {
                    y.style.display = 'none';
                    n.style.display = 'block';
                } else {
                    y.style.display = 'none';
                    n.style.display = 'block';
                }
            }

            $(document).ready(function() {
                $(document).on('change','#tolakInterview',function() {
                    console.log("ditekan");
                    var getID = $(this).val();
                    console.log(getID);
                    var div = $(this).parent();
                    var op = "";
                    var b = document.getElementById('bekerja');
                    var a = document.getElementById('alasan');
                    if (getID == "bekerja") {
                        b.style.display = 'block';
                        a.style.display = 'none';
                    } else {
                        b.style.display = 'none';
                        a.style.display = 'block';
                    }
                })
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
    </body>
</html>

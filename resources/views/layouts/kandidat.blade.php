<!DOCTYPE html>
<html lang="id">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>DIGIJOB</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        
        <!-- gambar logo di tab browser -->
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="/Atlantis/examples/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Atlantis/examples/assets/css/atlantis.min.css">
        <link rel="stylesheet" href="/cardSlide/style.css">
        <link rel="stylesheet" href="/css/loader.css">
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
                margin-bottom: -50px;
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
    <body onload="loadingPage()">
        <div class="">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                <!-- nama logo -->
                <a class="navbar-brand" href="/" style="color: white; font-weight:bold; background-color:#1572e8">DIGIJOB</a>
                <!-- Pembatas antar nama logo dan foto profil -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                </div>
                <div class="">
                    <a class="float-left" style="color:white; margin-right:13px; margin-top:12%; background-color:#1572e8; text-decoration:none;" href="/semua_pesan">
                        <i class="fas fa-envelope" style="font-size:23px; background-color:#1572e8;"></i>
                        <!-- menghitung total data pesan -->
                        @php
                            $ttl_pesan = $pesan->count();
                        @endphp
                        @if ($ttl_pesan !== 0)
                            <span style="background-color: red; width:12px; height:12px;border-radius:50%; display:inline-block;margin-left:-9px;"></span>                                                        
                        @endif
                    </a>
                    <div class="dropdown float-right">
                        <a class="" href="" role="button" data-toggle="dropdown" aria-expanded="false" style="background-color:#1572e8; text-decoration:none;">
                            @if ($kandidat->foto_4x6 !== null)
                                <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" style="width:40px; height:40px; border-radius:50%;" alt="">
                            @else
                                <img src="/gambar/default_user.png" style="width:40px; height:40px; border-radius:50%;" alt="">
                            @endif
                        </a>
                        <div class="dropdown-menu" style="width:13rem; height:auto; padding:2.5px; margin-left:-10rem">
                            <div class="" style="padding: 5px;">
                                <div class="" style="width:100%; height:auto;">
                                    @if ($kandidat->foto_4x6 !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" alt="" class="avatar-img rounded" style="">
                                    @else
                                        <img src="/gambar/default_user.png" alt="" class="avatar-img rounded" style="">                                                        
                                    @endif
                                </div>
                                <div class="">
                                    <b class="bold">{{$kandidat->nama}}</b>
                                    <p class="text-muted">{{$kandidat->email}}</p>
                                    @if (auth()->user()->verify_confirmed !== null)
                                        <span class="badge badge-pill badge-info">Terverifikasi</span>
                                    @endif
                                    @if ($kandidat->hubungan_perizin !== null)
                                        <span class="badge badge-pill badge-success">Profil</span>
                                    @endif
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/profil_kandidat">Profilku</a>
                            @if ($kandidat->hubungan_perizin == null)
                                <a class="dropdown-item" href="/isi_kandidat_personal">Lengkapi Profil</a>
                            @else
                                <a class="dropdown-item" href="/isi_kandidat_personal">Edit Profil</a>                                                
                            @endif
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="confirmation(event)">keluar</a>
                            <div class="dropdown-divider"></div>    
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Sistem Loading -->
            <div class="loading align">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            </div>
            <main class="">
                @yield('content')
                <!-- pembatas body dengan footer -->
                <div class="" style="height: 100px;"></div>
                
                <footer class="footer fixed-bottom" style="background-color: #1269db;">
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
                            <strong><a class="" style="color:white; background-color:#1269db; text-decoration:none; text-transform: uppercase;" href="/contact_us_kandidat">Hubungi Kami</a></strong>
                            {{-- 2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a> --}}
                        </div>
                    </div>
                </footer>
            </main>
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
        
        <!-- sistem halaman loading -->
        <script src="/js/loader.js"></script>
        
        <script type="text/javascript">
            // Alert konfirmasi keluar / Log out //
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

            // alert konfirmasi Terima Lowongan //
            function confirmLowongan(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
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

            // alert konfirmasi Batal Lowongan //
            function cancelLowongan(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
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

            // alert konfirmasi Keluar Perusahaan //
            function outPerusahaan(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
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

            // alert konfirmasi hapus data
            function hapusData(ev)
            {
                ev.preventDefault();
                var url = ev.currentTarget.getAttribute('href');
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

            // fungsi tampilan pilihan Negara Tujuan //
            $(document).ready(function() {
                $(document).on('change','#placement',function() {
                    var getID = $(this).val();
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
                                x.style.display = 'block';
                                y.style.display = 'block';
                                btn.style.display = 'block';
                                op+='<option value="" selected> -- Pilih Negara Tujuan -- </option>';
                                for(var i = 0; i < data.length; i++){
                                    op+='<option value="'+data[i].negara_id+'">'+data[i].negara+'</option>';
                                }
                                div.find('#negara_tujuan').html(" ");
                                div.find('#negara_tujuan').append(op);
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
                    }
                })
            });
            
            // fungsi memunculkan modal info saat masuk ke sebuah halaman
            $(window).on('load',function() {
                $('#info').modal('show');                                                   
            });

            $(window).on('load',function() {
                $('#persetujuan').modal('show');
            })

            // fungsi tampilan pilihan Konfirmasi Interview //
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

            // fungsi tampilan pilihan interview Kembali
            function backButton() {
                var y = document.getElementById("terimaInterview");
                var n = document.getElementById("batalInterview");
                if (n.style.display == 'block') {
                    y.style.display = 'block';
                    n.style.display = 'none';
                } else {
                    y.style.display = 'block';
                    n.style.display = 'none';
                }
            }

            //fungsi tampilan pilihan alasan menolak interview
            $(document).ready(function() {
                $(document).on('change','#tolakInterview',function() {
                    var getID = $(this).val();
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
            // fungsi tampilan mulai video
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
        </script>
    </body>
</html>
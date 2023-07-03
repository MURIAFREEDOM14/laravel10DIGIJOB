<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DIGIJOB-UGIPORT</title>
        <link rel="icon" href="/gambar/icon.ico" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        @livewireStyles
      <style>
        .img {
          width: 35%;
          height: auto;
        }
        video {
          width: 100%;
          height: auto;
        }
      </style>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
      <nav class="navbar navbar-expand-lg bg-warning">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">DIGIJOB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  @if (auth()->user()->verify_confirmed !== null)                      
                    <a class="nav-link" style="color:black" href="/" onclick="beranda(event)">Beranda<span class="sr-only"></span></a>                      
                  @endif
                </li>
                <li class="nav-item">
                  {{-- <a class="nav-link" style="color:black" href="/hubungi_kami">Contact Us</a> --}}
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" style="color: black;" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Keluar
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="{{ route('logout') }}" class="dropdown-item" onclick="confirmation(event)">keluar</a>
                      {{-- <a class="dropdown-item" onclick="return confirm('Apakah anda yakin mau keluar?')" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                          Keluar
                      </a> --}}
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
      </nav>
      <main class="">
          @yield('content')
      </main>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      @livewireScripts
      <script type="text/javascript">
      
      function beranda(ev)
      {
        ev.preventDefault();
        var url = ev.currentTarget.getAttribute('href');
        console.log(url);
        swal({
            title: 'Apakah anda yakin ingin kembali ke beranda?',
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
<!doctype html>
<html lang="in">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <title></title>
      <style>
        .hidden{
          display:block;
        }
        .img{
          border: 1px solid black;
          border-radius: 2%;
        }
        div {
          font-size: 13px;
          font-weight: bold;
          font-family: Poppins;
        }
      </style>
      @livewireStyles
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
      <!-- CSS Files -->
      <link rel="stylesheet" href="Atlantis/examples/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="Atlantis/examples/assets/css/atlantis.min.css">
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <a class="navbar-brand text-dark" href="">DIGIJOB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" style="font-weight: bold; color:black" href="/laman">Laman <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="font-weight: bold; color:black" href="/contact_us">Contact Us</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" style="font-weight: bold; color:black" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                Keluar
              </a>
              <div class="dropdown-menu">
              <a class="dropdown-item" onclick="return confirm('Apakah anda yakin mau keluar?')" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                Keluar
              </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <main class="">
          @yield('content')
      </main>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
      <!--   Core JS Files   -->
      <script src="Atlantis/examples/assets/js/core/jquery.3.2.1.min.js"></script>
      <script src="Atlantis/examples/assets/js/core/popper.min.js"></script>
      <script src="Atlantis/examples/assets/js/core/bootstrap.min.js"></script>
      <!-- jQuery UI -->
      <script src="Atlantis/examples/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
      <script src="Atlantis/examples/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
      
      <!-- jQuery Scrollbar -->
      <script src="Atlantis/examples/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
      <!-- Atlantis JS -->
      <script src="Atlantis/examples/assets/js/atlantis.min.js"></script>
      @livewireScripts
  
      {{-- <script>
        const selectAyah = document.getElementById("pilihanAyah");
        const inputAyah = document.getElementById("inputAyah");
          selectAyah.addEventListener("change", function () {
            const selectedAyah = selectAyah.value;

            // Semua input disembunyikan terlebih dahulu
            const inputAyahs = inputAyah.getElementsByTagName("input");
            for (let i = 0; i < inputAyahs.length; i++) {
                inputAyahs[i].style.display = "none";
            }

            // Jika nilai yang dipilih bukan kosong, tampilkan input yang sesuai
            if (selectedAyah !== "") {
                const selectedInputAyah = document.getElementById(selectedAyah);
                selectedInputAyah.style.display = "block";
            }
          });
      </script> --}}
      {{-- <script>
        const selectIbu = document.getElementById("pilihanIbu");
          const inputIbu = document.getElementById("inputIbu");
            selectIbu.addEventListener("change", function () {
              const selectedIbu = selectIbu.value;
  
              // Semua input disembunyikan terlebih dahulu
              const inputIbus = inputIbu.getElementsByTagName("input");
              for (let i = 0; i < inputIbus.length; i++) {
                  inputIbus[i].style.display = "none";
              }
  
              // Jika nilai yang dipilih bukan kosong, tampilkan input yang sesuai
              if (selectedIbu !== "") {
                  const selectedInputIbu = document.getElementById(selectedIbu);
                  selectedInputIbu.style.display = "block";
              }
            });
      </script>  --}}
    </body>
</html>
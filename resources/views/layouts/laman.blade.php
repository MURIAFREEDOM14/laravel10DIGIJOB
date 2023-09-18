<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!-- gambar icon pada tab halaman -->
  <link rel="icon" href="/gambar/icon.ico" type="image/x-icon"/>

  <title>DIGIJOB</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/gambar/icon.ico" rel="icon">
  <link href="/gambar/icon.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/Arsha/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/Arsha/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Arsha/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/Arsha/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/Arsha/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/Arsha/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/Arsha/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link rel="stylesheet" href="/css/captcha.css">
  <link rel="stylesheet" href="/css/loader.css">
  <!-- Template Main CSS File -->
  <link href="/Arsha/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
<style>
  p {
    font-family: 'poppins';
  }
  .img {
    width: 100%;
    height: auto;
  }
  #jeda {
    display: none;
  }
  #play {
    display: block;
  }
  #viewLoad {
    background-color: transparent;
    display: none;
    align-content: center;
  }
  #btnload {
    display: none;
  }
</style>
</head>
  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top" style="background-color: #FFC436;">
      <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="/laman" style="text-transform: uppercase; font-family:poppins; color:black">DIGIJOB</a></h1>
      <nav id="navbar" class="navbar" style="background-color: #FFC436;">
          <ul>
          {{-- <li><a class="nav-link scrollto" style="color: black" href="/register">Registrasi</a></li> --}}
          <li><a class="nav-link scrollto" style="color: black" href="/login">Login</a></li>
          <li><a class="nav-link scrollto" style="color: black" href="/hubungi_kami">Hubungi Kami</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

      </div>
  </header>
    <!-- ======= Hero Section ======= -->
    {{-- <section>
    </section><!-- End Hero --> --}}

    <main id="main" style="background-color: #468B97">
      <!-- ======= Clients Section ======= -->
      <section id="clients" class=" mt-5">
        <div class="container mt-5">
          <div class="content">
            <main class="mb-3">
              @include('flash_message')
              @yield('content')
            </main>
            <div class="loading-align text-center" id="viewLoad">
              <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            </div>
          </div>
        </div>
      </section><!-- End Cliens Section -->
      <!-- ======= Footer ======= -->
    </main><!-- End #main -->
    <footer id="footer" style="background-color:#FFC436;">
        <div class="container footer-bottom clearfix" >
          <div class="copyright" style="color:black">
            &copy; Copyright <strong><span>DIGIJOB-UGIPORT</span></strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
            {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
          </div>
        </div>
      </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/Arsha/assets/vendor/aos/aos.js"></script>
    <script src="/Arsha/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/Arsha/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/Arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/Arsha/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/Arsha/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="/Arsha/assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.9/dist/sweetalert2.all.min.js"></script>
    <script src="/js/captcha.js"></script>
    <script src="/js/loader.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Template Main JS File -->
    <script src="/Arsha/assets/js/main.js"></script>
    <script type="text/javascript">
      function enable() {
        var check = document.getElementById("check");
        var btn = document.getElementById("btn");
        if (check.checked) {
          btn.removeAttribute("disabled");
        } else {
          btn.disabled = "true";
        }
      }
      // sistem penyeleksian captcha
      grecaptcha.execute();
    </script>
  </body>
</html>
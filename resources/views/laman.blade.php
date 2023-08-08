<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DIGIJOB-UGIPORT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <style>
    body {
      font-family: Poppins;
    }
    .text1 {
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
    }
  </style>

  <!-- Favicons -->
  <link href="/gambar/icon.ico" rel="icon">
  <link href="/gambar/icon.ico" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="Arsha/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="Arsha/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Arsha/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Arsha/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Arsha/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="Arsha/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="Arsha/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="Arsha/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top" style="background-color: #FFD966">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="/laman" style="text-transform: uppercase; font-family:poppins; color:black">DIGIJOB</a></h1>
      <nav id="navbar" class="navbar" style="background-color: #FFD966;">
        <ul>
          {{-- <li><a class="nav-link scrollto active" style="color: black" href="#hero">Beranda</a></li> --}}
          {{-- <li><a class="nav-link scrollto disabled" style="color: gray;" href="/about_us">Tentang</a></li> --}}
          {{-- <li><a class="nav-link scrollto" style="color: black;" href="/register">Registrasi</a></li> --}}
          <li><a class="nav-link scrollto" style="color: black;" href="/login">Masuk</a></li>
          {{-- <li><a class="nav-link scrollto disabled" style="color: gray" href="/perbaikan">Portfolio</a></li> --}}
          <li><a class="nav-link scrollto" style="color: black" href="/hubungi_kami">Hubungi Kami</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="background-color: #468B97; height:100%">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 3"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" style="height: 150px">
              <div class="carousel-item text-center active">
                <h4 style="color: white; text-transform:uppercase">Murah / Low Cost</h4>
                <h5 style="color: white">Digijob solusi tepat untuk kebutuhan pekerja dengan biaya terjangkau.</h5>
              </div>
              <div class="carousel-item text-center">
                <h4 style="color: white; text-transform:uppercase">Mudah / On hand</h4>
                <h5 style="color: white">Digijob memfasilitasi dalam bentuk aplikasi yang aman dan mudah dioperasikan</h5>
              </div>
              <div class="carousel-item text-center">
                <h4 style="color: white; text-transform:uppercase">Cepat / Efficient</h4>
                <h5 style="color: white">Pelayanan yang cepat dan dukungan optimal yang kami berikan kepada pengguna</h5>
              </div>
              <div class="carousel-item text-center">
                <h4 style="color: white; text-transform:uppercase">Akurat / Accurate</h4>
                <h5 style="color: white">Digijob menyediakan beberapa informasi yang akurat dan data valid &nbsp;</h5>
              </div>
              <div class="carousel-item text-center">
                <h4 style="color: white; text-transform:uppercase">Menyatu / integrate</h4>
                <h5 style="color: white">Terintegrasi untuk dapat melayani anda agar dapat berhubungan</h5>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              {{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              {{-- <span class="carousel-control-next-icon" aria-hidden="true"></span> --}}
              <span class="visually-hidden">Next</span>
            </button>
          </div>
            {{-- <a href="https://youtu.be/9W05yY_pQ4I" class="glightbox btn-watch-video"><i class="bi bi-play-circle" style="color: black"></i><span style="color: black">Lihat Video</span></a> --}}
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 d-flex flex-column justify-content-center pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="200">
          <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            {{-- <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 0"></button>
            </div> --}}
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="1500">
                <img src="Arsha/assets/img/hero-img.png" class="img-fluid text-center" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <p style="color: black"></p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1500">
                <img src="Arsha/assets/img/hero-img.png" class="img-fluid" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <p style="color: black"></p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1500">
                <img src="Arsha/assets/img/hero-img.png" class="img-fluid" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <p style="color: black"></p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1500">
                <img src="Arsha/assets/img/hero-img.png" class="img-fluid" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <p style="color: black"></p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="1500">
                <img src="Arsha/assets/img/hero-img.png" class="img-fluid" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <p style="color: black"></p>
                </div>
              </div>
            </div>
            {{-- <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button> --}}
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <!-- Button trigger modal -->
          {{-- <button type="button" class="btn btn-outline-primary" style="width: 15rem; height:3rem;" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Registrasi
          </button>      --}}
          <a class="btn btn-outline-primary" href="/register" style="width: 15rem; height:3rem;">
            Registrasi
          </a>     
        </div>
        <div class="section-title">
          <img src="/gambar/icon.ico" width="150" height="150" alt="">
        </div>
        <div class="row mx-5">
          <div class="col-md-12 align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box text-center" style="">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="digijob_system" style="text-transform: uppercase;">Digijob System</a></h4>
              <p class="text1">
                DIGIJOB dirancang untuk membantu organisasi dalam upaya mereka memaksimalkan efisiensi dan efektivitas proses perekrutan pekerja lokal dan migran. DIGIJOB mengubah kemampuan rekrutmen yang secara tradisional digunakan oleh industri rekrutmen pekerja menjadi platform online tunggal yang mudah digunakan dan hemat biaya. Sebagai sistem yang lengkap, DIGIJOB menawarkan nilai yang luar biasa kepada pengguna.   DIGIJOB dirancang agar sesuai dengan proses rekrutmen pekerja di negara-negara sumber tenaga kerja lokal dan luar negeri. Ruang lingkup DIGIJOB mencakup semua langkah utama dalam proses perekrutan pekerja migran dan menyediakan portal manajemen yang komprehensif bagi pengguna. Selain itu, DIGIJOB dirancang untuk meminimalkan upaya administratif dan menjadi solusi sederhana dan mudah digunakan untuk perekrutan pekerja migran.
              </p>
            </div>
          </div>
        </div>
        <div class="row mx-5">
          <div class="col-md-12 align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="/benefits" style="text-transform: uppercase;">Keunggulan</a></h4>
              <p class="text1">
                Murah, Mudah, Cepat, Akurat, Menyatu
              </p>
            </div>
          </div>
        </div>
        <div class="row mx-5">
          <div class="col-md-12 align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="/features" style="text-transform: uppercase;">Tambahan</a></h4>
              <p class="text1">
                Jaminan kehadiran pekerja di Pusat Medis Terakreditasi untuk pemeriksaan kesehatan pekerja.
              </p>
            </div>
          </div>
        </div>
        <div class="row mx-5">
          <div class="col-md-12 align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box text-center">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="/hubungi_kami" style="text-transform: uppercase;">Hubungi Kami</a></h4>
              <p class="text1">
                Hubungi kami disini
                <br>&nbsp;
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family:poppins">Anda ingin daftar sebagai siapa?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <a href="/register/kandidat" style="color: white">
                    <div class="icon-box text-center" style="border-style: outset; background-color: #19A7CE">
                      <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                      <h4 style="text-transform: uppercase;color: white">Pencari Kerja</h4>  
                    </div>
                  </a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <a href="/register/akademi" style="color: white">
                    <div class="icon-box text-center" style="border-style: outset;background-color: #FFD966">
                      <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                      <h4 style="text-transform: uppercase; color: white">Akademi</h4>
                    </div>
                  </a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <a href="/register/perusahaan" style="color: white">
                    <div class="icon-box text-center" style="border-style: outset;background-color: #2bb930">
                      <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                      <h4 style="text-transform: uppercase; color: white">Perusahaan</h4>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Services Section -->

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="background-color: #FFD966;" class="">
    <div class="container footer-bottom clearfix">
      <div class="copyright" style="color:black;">
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
  <script src="Arsha/assets/vendor/aos/aos.js"></script>
  <script src="Arsha/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Arsha/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="Arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="Arsha/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="Arsha/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="Arsha/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="Arsha/assets/js/main.js"></script>

</body>

</html>
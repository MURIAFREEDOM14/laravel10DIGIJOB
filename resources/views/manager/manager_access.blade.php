<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DIGIJOB-UGIPORT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="Arsha/assets/img/favicon.png" rel="icon">
  <link href="Arsha/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

  <link rel="stylesheet" href="Atlantis/examples/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="Atlantis/examples/assets/css/atlantis.min.css">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="Atlantis/examples/assets/css/demo.css">

  <!-- Template Main CSS File -->
  <link href="Arsha/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    body{
        background-color: #37517e;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="/laman">ProyekPortal</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#contact">Hubungi</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container my-5 ">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <form action="/manager_access" method="POST">
                @csrf
                <div class="form-group form-group-default">
                    <label>Masukkan Email</label>
                    <input id="Name" name="email" type="email" required class="form-control" placeholder="Masukkan Email">
                </div>            
                <div class="form-group form-group-default">
                    <label>Masukkan Password</label>
                    <input id="password" name="password" type="password" required class="form-control" placeholder="Masukkan Password">
                </div>            
                <div class="form-group form-group-default">
                    <label>Masukkan Kode</label>
                    <input id="kode" name="kode" type="password" required class="form-control" placeholder="Masukkan Kode">
                </div>            
                <div class="d-flex justify-content-center justify-content-lg-start mb-5">
                    <button type="submit" class="btn-get-started scrollto">Masuk</button>
                </div>    
            </form>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="Arsha/assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container footer-bottom clearfix mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>ProyekPortal</span></strong>. All Rights Reserved
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
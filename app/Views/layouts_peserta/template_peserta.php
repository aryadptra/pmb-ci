<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/favicon.ico" rel="icon">
  <link href="/assets/bizland/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Vendor CSS Files -->
  <link href="/assets/bizland/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/bizland/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/assets/bizland/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/bizland/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/assets/bizland/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="/assets/bizland/vendor/aos/aos.css" rel="stylesheet">
  <!-- daterange picker -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/daterangepicker/daterangepicker.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Template Main CSS File -->
  <link href="/assets/bizland/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand - v1.1.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i> <a href="mailto:contact@example.com">pmb-online@ba-university.ac.id</a>
        <i class="icofont-phone"></i> (021) 4450668, 4450669
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <?= $this->renderSection('header') ?>
  
  <!-- ======= Content ======= -->
  <?= $this->renderSection('content') ?>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container py-4">
      <div class="copyright">
        <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#">Bang Ambo University</a>.</strong> All rights reserved.
      </div>
      <div class="credits">
        <b>Version</b> 1.0.0
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/bizland/vendor/jquery/jquery.min.js"></script>
  <script src="/assets/bizland/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/bizland/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/assets/bizland/vendor/php-email-form/validate.js"></script>
  <script src="/assets/bizland/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="/assets/bizland/vendor/counterup/counterup.min.js"></script>
  <script src="/assets/bizland/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="/assets/bizland/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets/bizland/vendor/venobox/venobox.min.js"></script>
  <script src="/assets/bizland/vendor/aos/aos.js"></script>
  <!-- Sweetalert 2 -->
  <script src="/assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="/assets/adminlte3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- InputMask -->
  <script src="/assets/adminlte3/plugins/moment/moment.min.js"></script>
  <script src="/assets/adminlte3/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- date-range-picker -->
  <script src="/assets/adminlte3/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="/assets/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Template Main JS File -->
  <script src="/assets/bizland/js/main.js"></script>
  <!-- page script -->
  <?= $this->renderSection('script') ?>

</body>

</html>
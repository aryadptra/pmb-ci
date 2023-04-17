<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
    <h1 class="logo mr-auto"><a href="<?php echo base_url('/'); ?>">Bang Ambo<span>University</span></a></h1>
  </div>
</header>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Pendaftaran</h2>
        <ol>
          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
          <li>Pendaftaran</li>
        </ol>
      </div>

    </div>
  </section>

  <!-- ======= Pendaftaran ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h3><span>Halaman Pendaftaran</span></h3>
        <p>Aplikasi Pendaftaran Mahasiswa Baru - Bang Ambo University</p>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
          <img src="/assets/bizland/img/about.jpg" class="img-fluid" alt="">
        </div>

        <div class="col-lg-6">
          <form id="formPendaftaran" role="form" class="php-email-form">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="icofont-users-alt-5"></i></span>
              </div>
              <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" autofocus/>
            </div>
            <small id="nama_error" class="form-text text-danger mb-3"></small>
            
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="icofont-email"></i></span>
              </div>
              <input type="text" class="form-control" name="email" placeholder="Email"/>
            </div>
            <small id="email_error" class="form-text text-danger mb-3"></small>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i id="show-password" class="icofont-eye-blocked"></i></span>
              </div>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
            </div>
            <small id="password_error" class="form-text text-danger mb-3"></small>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i id="show-comfirmpassword" class="icofont-eye-blocked"></i></span>
              </div>
              <input type="password" class="form-control" id="comfirm_password" name="comfirm_password" placeholder="Comfirm Password"/>
            </div>
            <small id="comfirm_password_error" class="form-text text-danger mb-3"></small>

            <div class="text-center mb-2">
              <button class="col-lg" type="submit" id="btn-pendaftaran">Daftar</button>
            </div>
            <p class="mb-2">
              <a href="<?php echo base_url('login'); ?>">Sudah punya akun? Silahkan Login!</a>
            </p>
          </form>
        </div>

      </div>

    </div>
  </section>
  
</main>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {

    //Show Password
    $('#show-password').on('click', function(){
        if ($(this).hasClass('icofont-eye-blocked')) {
            $('#password').attr('type', 'text');
            $(this).removeClass('icofont-eye-blocked');
            $(this).addClass('icofont-eye');
        } else {
            $('#password').attr('type', 'password');
            $(this).removeClass('icofont-eye');
            $(this).addClass('icofont-eye-blocked');
        }
    });
    //-------------------------------------------------------------------

    //Show Comfirm Password
    $('#show-comfirmpassword').on('click', function(){
        if ($(this).hasClass('icofont-eye-blocked')) {
            $('#comfirm_password').attr('type', 'text');
            $(this).removeClass('icofont-eye-blocked');
            $(this).addClass('icofont-eye');
        } else {
            $('#comfirm_password').attr('type', 'password');
            $(this).removeClass('icofont-eye');
            $(this).addClass('icofont-eye-blocked');
        }
    });
    //-------------------------------------------------------------------

    //Submit pendaftaran user
    $('#btn-pendaftaran').on('click', function(){
      const formPendaftaran = $('#formPendaftaran');
      
      $.ajax({
        url: "pendaftaran/daftarAkun",
        method: "POST",
        data: formPendaftaran.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data Error
          if(data.error){
            if(data.daftar_akun_error['nama'] != '') $('#nama_error').html(data.daftar_akun_error['nama']);   
            else $('#nama_error').html('');

            if(data.daftar_akun_error['email'] != '') $('#email_error').html(data.daftar_akun_error['email']);   
            else $('#email_error').html('');

            if(data.daftar_akun_error['password'] != '') $('#password_error').html(data.daftar_akun_error['password']);   
            else $('#password_error').html('');

            if(data.daftar_akun_error['comfirm_password'] != '') $('#comfirm_password_error').html(data.daftar_akun_error['comfirm_password']);   
            else $('#comfirm_password_error').html('');
          }

          //Pendaftaran Sukses
          if(data.success){
            formPendaftaran.trigger('reset');
            $('#nama_error').html('');
            $('#email_error').html('');
            $('#password_error').html(''); 
            $('#comfirm_password_error').html(''); 
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Pendaftaran Berhasil!',
              showConfirmButton: false,
              timer: 1500
            });
            window.location.replace(data.link);
          }
            
        }
        
      });

    });
    //-------------------------------------------------------------------

  });

</script>
<?= $this->endSection() ?>
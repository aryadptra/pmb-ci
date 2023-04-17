<?= $this->extend('layouts_peserta/template_peserta') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
    <h1 class="logo mr-auto"><a href="#">Bang Ambo<span>University</span></a></h1>
    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="#">Home</a></li>
        <li><a href="<?php echo base_url('pendaftaran/logout'); ?>">Logout</a></li>
      </ul>
    </nav>
  </div>
</header>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main" data-aos="fade-up">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Upload Berkas Pendaftaran</h2>
        <ol>
          <li><a href="<?php echo base_url('pendaftaran/tahapsatu'); ?>">Biodata</a></li>
          <li><a href="<?php echo base_url('pendaftaran/tahapdua'); ?>">Prodi</a></li>
          <li><b>Berkas</b></li>
          <li>Resume</li>
        </ol>
      </div>

    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <div class="member-img">
              <img src="<?= $lokasi_foto; ?>" class="img-fluid" id="previewImg" alt="">
            </div>
          </div>
        </div>

        <div class="col-lg">
          <form id="formUploadBerkas" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
            <input type="hidden" name="idPendaftaran" value="<?=$idPendaftaran; ?>" />
            <!-- Upload Berkas Pendaftaran -->
            <label for="tahun">Pas photo 3 x 4 (Ukuran Max. 500Kb Dengan Format .jpg)</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewFile(this);">
              <small id="foto_error" class="form-text text-danger mb-3"></small>
              <label class="custom-file-label" for="foto"><?= $foto_peserta; ?></label>
            </div>
            <label for="tahun">Berkas syarat pendaftaran dalam 1 file (Ukuran Max. 2Mb Dengan Format .pdf)</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="berkas" name="berkas">
              <small id="berkas_error" class="form-text text-danger mb-3"></small>
              <label class="custom-file-label" for="berkas"><?= $berkas_peserta; ?></label>
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-2">
              <button class="col-lg-4" type="submit" id="btn-pendaftaran3">Simpan dan Lanjutkan</button>
              <?php if ($tahap_tiga == "Selesai"): ?>
                <a href="<?php echo base_url('pendaftaran/tahapempat'); ?>" role="button" class="btn btn-light col-lg-3">Lewati</a>
              <?php endif ?>
            </div>
          </form>
        </div>

      </div>

    </div>
  </section>

</main>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>

  //Preview pas photo yang di upload peserta
  function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];
    if(file){
        var reader = new FileReader();
        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
  }
  //-------------------------------------------------------------------

  $(document).ready(function() {

    bsCustomFileInput.init();

    //Submit pendaftaran tahap tiga
    $('#formUploadBerkas').on('submit', function(e){
      e.preventDefault();
      
      $.ajax({
        url: "<?php echo base_url('pendaftaran/saveTahapTiga')?>",
        method: "POST",
        data:new FormData(this),  
        contentType: false,  
        cache: false,  
        processData:false,
        dataType: "JSON",
        success: function (res) {
          //Data error 
          if(res.error){
            if(res.tahap_tiga_error['foto'] != '') $('#foto_error').html(res.tahap_tiga_error['foto']);
            else $('#foto_error').html('');

            if(res.tahap_tiga_error['berkas'] != '') $('#berkas_error').html(res.tahap_tiga_error['berkas']);
            else $('#berkas_error').html('');
          }

          //Pendaftaran tahap tiga sukses
          if(res.success){
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Tahap tiga berhasil!',
              showConfirmButton: false,
              timer: 1500
            });
            window.location.replace(res.link);
          }
            
        }
        
      });

    });
    //-------------------------------------------------------------------

    

  });

</script>
<?= $this->endSection() ?>
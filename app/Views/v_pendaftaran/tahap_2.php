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
        <h2>Pilih Fakultas Dan Prodi</h2>
        <ol>
          <li><a href="<?php echo base_url('pendaftaran/tahapsatu'); ?>">Biodata</a></li>
          <li><b>Prodi</b></li>
          <li>Berkas</li>
          <li>Resume</li>
        </ol>
      </div>

    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg">
          <form id="formFakultasProdi" method="post" role="form" class="php-email-form">
            <input type="hidden" name="idPendaftaran" value="<?=$idPendaftaran; ?>" />
            <!-- Pilih Fakultas Dan Prodi -->
            <label for="tahun">Pilih Fakultas Dan Prodi Pada Bang Ambo University</label>
            <div class="form-group">
              <select class="form-control" name="fakultas" id="fakultas" />
                <option value="<?=$IdFakultas; ?>"><?=$nama_fakultas; ?></option>
                <?php foreach ($fakultas as $fak): ?>
                  <option value="<?=$fak['id']; ?>"><?=$fak['nama_fakultas']; ?></option>
                <?php endforeach ?>
              </select>
              <small id="fakultas_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <select class="form-control" id="prodi" name="prodi"/>
                <option value="<?=$IdProdi; ?>"><?=$nama_prodi; ?></option>
              </select>
              <small id="prodi_error" class="form-text text-danger mb-3"></small>
            </div>

            <!-- Tombol Simpan -->
            <div class="mb-2">
              <button class="col-lg-3" type="submit" id="btn-pendaftaran2">Simpan dan Lanjutkan</button>
              <?php if ($tahap_dua == "Selesai"): ?>
                <a href="<?php echo base_url('pendaftaran/tahaptiga'); ?>" role="button" class="btn btn-light col-lg-3">Lewati</a>
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
  $(document).ready(function() {

    //Menampilkan Pilihan Prodi Berdasarkan Fakultas
    $('#fakultas').on('change', function(){
      const id = $(this).val();
      
      $.ajax({
        url: "<?php echo base_url('pendaftaran/ajaxPilihanProdi')?>",
        method: "POST",
        data : {id: id},
        async : true,
        dataType: "JSON",
        success: function (data) {
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
              html += '<option value='+data[i].id+'>'+data[i].nama_prodi+'</option>';
          }
          $('#prodi').html(html);  
        }
        
      });

    });
    //-------------------------------------------------------------------

    //Submit pendaftaran tahap dua
    $('#btn-pendaftaran2').on('click', function(){
      const formFakultasProdi = $('#formFakultasProdi');
      
      $.ajax({
        url: "<?php echo base_url('pendaftaran/saveTahapDua')?>",
        method: "POST",
        data: formFakultasProdi.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data error 
          if(data.error){
            if(data.tahap_dua_error['fakultas_id'] != '') $('#fakultas_error').html(data.tahap_dua_error['fakultas_id']);   
            else $('#fakultas_error').html('');

            if(data.tahap_dua_error['prodi_id'] != '') $('#prodi_error').html(data.tahap_dua_error['prodi_id']);   
            else $('#prodi_error').html('');
          }
          //Pendaftaran tahap dua sukses
          if(data.success){
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Tahap dua berhasil!',
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
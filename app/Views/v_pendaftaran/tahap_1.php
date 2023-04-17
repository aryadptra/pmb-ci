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
        <h2>Biodata Peserta</h2>
        <ol>
          <li><b>Biodata</b></li>
          <li>Prodi</li>
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
          <form id="formBiodataPeserta" method="post" role="form" class="php-email-form">
            <input type="hidden" name="idPendaftaran" value="<?=$cekTahapSatu['id']; ?>" />
            <!-- Data Diri Peserta -->
            <label for="tahun">Data Diri Peserta</label>
            <div class="form-group">
              <input type="text" class="form-control" name="nama_peserta" placeholder="Nama Peserta" value="<?=$cekTahapSatu['nama_peserta']; ?>" />
              <small id="nama_peserta_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?=$cekTahapSatu['tempat_lahir']; ?>"/>
              <small id="tempat_lahir_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" name="tanggal_lahir" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Tanggal Lahir" value="<?=ubah_tgl2($cekTahapSatu['tanggal_lahir']); ?>"/>
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="icofont-calendar"></i></div>
                </div>
              </div>
              <small id="tanggal_lahir_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <select class="form-control" name="jenis_kelamin"/>
                <option value="">--Jenis Kelamin--</option>
                <option value="Laki-laki" <?php if ($cekTahapSatu['jenis_kelamin'] == 'Laki-laki') {echo "selected";}  ?> >Laki-laki</option>
                <option value="Perempuan" <?php if ($cekTahapSatu['jenis_kelamin'] == 'Perempuan') {echo "selected";}  ?> >Perempuan</option>
              </select>
              <small id="jenis_kelamin_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <select class="form-control" name="agama"/>
                <option value="">--Agama--</option>
                <option value="Islam" <?php if ($cekTahapSatu['agama'] == 'Islam') {echo "selected";}  ?> >Islam</option>
                <option value="Kristen" <?php if ($cekTahapSatu['agama'] == 'Kristen') {echo "selected";}  ?> >Kristen</option>
                <option value="Katolik" <?php if ($cekTahapSatu['agama'] == 'Katolik') {echo "selected";}  ?> >Katolik</option>
                <option value="Hindu" <?php if ($cekTahapSatu['agama'] == 'Hindu') {echo "selected";}  ?> >Hindu</option>
                <option value="Budha" <?php if ($cekTahapSatu['agama'] == 'Budha') {echo "selected";}  ?> >Budha</option>
                <option value="Konghucu" <?php if ($cekTahapSatu['agama'] == 'Konghucu') {echo "selected";}  ?> >Konghucu</option>
              </select>
              <small id="agama_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="no_hp" placeholder="No. Handphone" value="<?=$cekTahapSatu['no_hp']; ?>"/>
              <small id="no_hp_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="alamat_peserta" rows="5" placeholder="Alamat"><?=$cekTahapSatu['alamat_peserta']; ?></textarea>
              <small id="alamat_peserta_error" class="form-text text-danger mb-3"></small>
            </div>

            <!-- Data Orangtua Peserta -->
            <label for="tahun">Data Orangtua Peserta</label>
            <div class="form-group">
              <input type="text" class="form-control" name="nama_orangtua" placeholder="Nama Orangtua" value="<?=$cekTahapSatu['nama_orangtua']; ?>"/>
              <small id="nama_orangtua_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="pekerjaan_orangtua" placeholder="Pekerjaan Orangtua" value="<?=$cekTahapSatu['pekerjaan_orangtua']; ?>"/>
              <small id="pekerjaan_orangtua_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="no_hp_orangtua" placeholder="No. Handphone Orangtua" value="<?=$cekTahapSatu['no_hp_orangtua']; ?>"/>
              <small id="no_hp_orangtua_error" class="form-text text-danger mb-3"></small>
            </div>

            <!-- Data Sekolah Peserta -->
            <label for="tahun">Data Sekolah Peserta</label>
            <div class="form-group">
              <input type="text" class="form-control" name="nama_sekolah" placeholder="Nama Sekolah" value="<?=$cekTahapSatu['nama_sekolah']; ?>"/>
              <small id="nama_sekolah_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="tahun_lulus" placeholder="Tahun Lulus" value="<?=$cekTahapSatu['tahun_lulus']; ?>"/>
              <small id="tahun_lulus_error" class="form-text text-danger mb-3"></small>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="alamat_sekolah" rows="5" placeholder="Alamat Sekolah"><?=$cekTahapSatu['alamat_sekolah']; ?></textarea>
              <small id="alamat_sekolah_error" class="form-text text-danger mb-3"></small>
            </div>

            <!-- Tombol Simpan -->
            <div class="mb-2">
              <button class="col-lg-3" type="submit" id="btn-pendaftaran1">Simpan dan Lanjutkan</button>
              <?php if ($cekTahapSatu['tahap_satu'] == "Selesai"): ?>
                <a href="<?php echo base_url('pendaftaran/tahapdua'); ?>" role="button" class="btn btn-light col-lg-3">Lewati</a>
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

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Submit pendaftaran tahap satu
    $('#btn-pendaftaran1').on('click', function(){
      const formBiodataPeserta = $('#formBiodataPeserta');
      
      $.ajax({
        url: "<?php echo base_url('pendaftaran/saveTahapSatu')?>",
        method: "POST",
        data: formBiodataPeserta.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data Error
          if(data.error){
            if(data.tahap_satu_error['nama_peserta'] != '') $('#nama_peserta_error').html(data.tahap_satu_error['nama_peserta']);   
            else $('#nama_peserta_error').html('');

            if(data.tahap_satu_error['tempat_lahir'] != '') $('#tempat_lahir_error').html(data.tahap_satu_error['tempat_lahir']);   
            else $('#tempat_lahir_error').html('');

            if(data.tahap_satu_error['tanggal_lahir'] != '') $('#tanggal_lahir_error').html(data.tahap_satu_error['tanggal_lahir']);   
            else $('#tanggal_lahir_error').html('');

            if(data.tahap_satu_error['jenis_kelamin'] != '') $('#jenis_kelamin_error').html(data.tahap_satu_error['jenis_kelamin']);   
            else $('#jenis_kelamin_error').html('');

            if(data.tahap_satu_error['agama'] != '') $('#agama_error').html(data.tahap_satu_error['agama']);   
            else $('#agama_error').html('');

            if(data.tahap_satu_error['no_hp'] != '') $('#no_hp_error').html(data.tahap_satu_error['no_hp']);   
            else $('#no_hp_error').html('');

            if(data.tahap_satu_error['alamat_peserta'] != '') $('#alamat_peserta_error').html(data.tahap_satu_error['alamat_peserta']);   
            else $('#alamat_peserta_error').html('');

            if(data.tahap_satu_error['nama_orangtua'] != '') $('#nama_orangtua_error').html(data.tahap_satu_error['nama_orangtua']);   
            else $('#nama_orangtua_error').html('');

            if(data.tahap_satu_error['pekerjaan_orangtua'] != '') $('#pekerjaan_orangtua_error').html(data.tahap_satu_error['pekerjaan_orangtua']);   
            else $('#pekerjaan_orangtua_error').html('');

            if(data.tahap_satu_error['no_hp_orangtua'] != '') $('#no_hp_orangtua_error').html(data.tahap_satu_error['no_hp_orangtua']);   
            else $('#no_hp_orangtua_error').html('');

            if(data.tahap_satu_error['nama_sekolah'] != '') $('#nama_sekolah_error').html(data.tahap_satu_error['nama_sekolah']);   
            else $('#nama_sekolah_error').html('');

            if(data.tahap_satu_error['tahun_lulus'] != '') $('#tahun_lulus_error').html(data.tahap_satu_error['tahun_lulus']);   
            else $('#tahun_lulus_error').html('');

            if(data.tahap_satu_error['alamat_sekolah'] != '') $('#alamat_sekolah_error').html(data.tahap_satu_error['alamat_sekolah']);   
            else $('#alamat_sekolah_error').html('');
          }

          //Pendaftaran tahap satu sukses
          if(data.success){    
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Tahap satu berhasil!',
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
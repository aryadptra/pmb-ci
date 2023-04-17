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
        <h2>Dashboard Peserta</h2>
      </div>
    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h3>Nomor Pendaftaran  <span><?=$pendaftaran['nomor_pendaftaran']; ?></span></h3> 
        <p>Pendaftaran berhasil dilakukan pada tanggal - <?=tgl_indonesia($pendaftaran['tanggal_pendaftaran']); ?></p>
      </div>
      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <div class="member-img">
              <img src="/file_peserta/<?=$pendaftaran['foto']; ?>" class="img-fluid" id="previewImg" alt="">
            </div>
            <!-- Preview Berkas Pendaftaran -->
            <button type="button" class="btn btn-light col-lg mt-2" data-toggle="modal" data-target="#exampleModal">
              View Berkas Pendaftaran
            </button>
          </div>
        </div>

        <div class="col-lg">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Biodata</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Data Orangtua</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="sekolah-tab" data-toggle="tab" href="#sekolah" role="tab" aria-controls="sekolah" aria-selected="false">Data Sekolah</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="fakultas-tab" data-toggle="tab" href="#fakultas" role="tab" aria-controls="fakultas" aria-selected="false">Fakultas/Prodi</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Biodata</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Nama</td>
                    <td><?=$pendaftaran['nama_peserta']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Tempat Lahir</td>
                    <td><?=$pendaftaran['tempat_lahir']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Tanggal Lahir</td>
                    <td><?=tgl_indonesia($pendaftaran['tanggal_lahir']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Jenis Kelamin</td>
                    <td><?=$pendaftaran['jenis_kelamin']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Agama</td>
                    <td><?=$pendaftaran['agama']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td>No. Handphone</td>
                    <td><?=$pendaftaran['no_hp']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">7</th>
                    <td>Alamat</td>
                    <td><?=$pendaftaran['alamat_peserta']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Orangtua</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Nama Orangtua</td>
                    <td><?=$pendaftaran['nama_orangtua']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Pekerjaan Orangtua</td>
                    <td><?=$pendaftaran['pekerjaan_orangtua']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>No. Handphone Orangtua</td>
                    <td><?=$pendaftaran['no_hp_orangtua']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="sekolah" role="tabpanel" aria-labelledby="sekolah-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sekolah</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Nama Sekolah</td>
                    <td><?=$pendaftaran['nama_sekolah']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Tahun Lulus</td>
                    <td><?=$pendaftaran['tahun_lulus']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Alamat Sekolah</td>
                    <td><?=$pendaftaran['alamat_sekolah']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="fakultas" role="tabpanel" aria-labelledby="fakultas-tab">
              <table class="table table-striped mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fakultas/Prodi</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Fakultas</td>
                    <td><?=$nama_fakultas; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Prodi</td>
                    <td><?=$nama_prodi; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Cetak Bukti Pendaftaran -->
          <a href="<?php echo base_url('pendaftaran/buktipendaftaran'); ?>" type="button" class="btn btn-primary col-lg-4 mt-2" type="submit" id="btn-cetakKartu" target="_blank">Cetak Bukti Pendaftaran</a>

          <!-- Tanggal Pengumuman Lulus Administrasi -->
          <?php if ($tgl_sekarang < $tgl_pengumuman): ?>
            <div class="alert alert-info mt-4" role="alert">
              <h4 class="alert-heading">Pengumuman Lulus Administrasi!</h4>
              <p>Pengumuman lulus administrasi dapat dilihat pada tanggal <b><?= tgl_indonesia($tgl_pengumuman); ?></b></p>
              <hr>
            </div>
          <?php endif ?>

          <!-- Verifikasi Pendaftaran -->
          <?php if ($tgl_sekarang >= $tgl_pengumuman): ?>
            <!-- Lulus -->
            <?php if ($pendaftaran['status_verifikasi'] == "Lulus"): ?>
              <div class="alert alert-primary mt-4" role="alert">
                <h4 class="alert-heading">Selamat!</h4>
                <p>Anda lulus pendaftaran penerimaan mahasiswa baru Bang Ambo University pada prodi <b><?=$nama_prodi." - ".$nama_fakultas; ?></b></p>
                <hr>
              </div>
            <?php endif ?>
            <!-- Tidak Lulus -->
            <?php if ($pendaftaran['status_verifikasi'] == "Tidak Lulus"): ?>
              <div class="alert alert-danger mt-4" role="alert">
                <h4 class="alert-heading">Mohon maaf!</h4>
                <p>Anda tidak lulus pendaftaran penerimaan mahasiswa baru Bang Ambo University</b></p>
                <hr>
              </div>
            <?php endif ?>
          <?php endif ?>
        </div>
      </div>
    </div>
  </section>

</main>

<!-- Preview Berkas -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Berkas Pendaftaran <?=$pendaftaran['nama_peserta']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <embed src="/file_peserta/<?=$pendaftaran['berkas']; ?>" type="application/pdf" width="100%" height="450px">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>




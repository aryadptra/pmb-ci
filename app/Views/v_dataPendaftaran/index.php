<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Data Pendaftaran Mahasiswa Baru</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Pendaftaran Mahasiswa Baru</h3>
              </div>
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nomor Pendaftaran</th>
                    <th>Nama Peserta</th>
                    <th>Prodi</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {

    //Menampilkan data pendaftaran (dataTable server-side)
    $('#example1').DataTable({ 
      "responsive": true,
      "autoWidth": false,
      "processing" : true, 
      "serverSide" : true, 
      "order"    : [], 

      "ajax": {
        "url" : "datapendaftaran/ajaxDataPendaftaran",
        "type"  : "POST"
      },

      "columnDefs" : [
        { 
          "targets" : [ 0 ], 
          "orderable" : false,
        },
      ],
    });
    //-------------------------------------------------------------------

    //Lulus Pendaftaran
    $('body').on('click', '.btn-lulusPendaftaran', function (e) {
      e.preventDefault();
      const urlLulus = $(this).attr('href');

      Swal.fire({
        title: 'Lulus Pendaftaran?',
        text: "Apakah peserta memenuhi persyaratan pendaftaran?",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, lulus!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: urlLulus,
            method: "POST",
            success: function (response) {
                $('#example1').DataTable().ajax.reload()
                toastr.info('Data pendaftaran berhasil diverifikasi.');
            }
          });
        }
      });
      
    });
    //-------------------------------------------------------------------

    //Tidak Lulus Pendaftaran
    $('body').on('click', '.btn-tidakLulusPendaftaran', function (e) {
      e.preventDefault();
      const urlTidakLulus = $(this).attr('href');

      Swal.fire({
        title: 'Tidak Lulus Pendaftaran?',
        text: "Apakah peserta TIDAK memenuhi persyaratan pendaftaran?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, tidak lulus!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: urlTidakLulus,
            method: "POST",
            success: function (response) {
                $('#example1').DataTable().ajax.reload()
                toastr.info('Data pendaftaran berhasil diverifikasi.');
            }
          });
        }
      });
      
    });
    //-------------------------------------------------------------------

  });

</script>
<?= $this->endSection() ?>


<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Data Prodi <?=$nama_fakultas; ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- Modal Add -->
            <?php include 'add.php';  ?>

            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Prodi <?=$nama_fakultas; ?></h3>

                <div class="card-tools">
                  <a data-toggle="tooltip" data-placement="top" title="Add">
                    <button id="addBankSoal" type="button" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#modalAdd">
                      <i class="fas fa-plus"></i>
                    </button>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Prodi</th>
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

    <!-- Modal Edit -->
    <?php include 'edit.php';  ?>
  </div>
  <!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  <?php 
      $link = base_url('dataprodi/ajaxDataProdi/'.$id_fakultas);
  ?>

  $(document).ready(function() {

    //Menampilkan data prodi (dataTable server-side)
    $('#example1').DataTable({ 
      "responsive": true,
      "autoWidth": false,
      "processing" : true, 
      "serverSide" : true, 
      "order"    : [], 

      "ajax": {
        "url" : "<?php echo $link; ?>",
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

    //Save input data prodi
    $('#btn-saveDataProdi').on('click', function(){
      const formInput = $('#formInputDataProdi');
      
      $.ajax({
        url: "<?php echo base_url('dataprodi/add')?>",
        method: "POST",
        data: formInput.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data error 
          if(data.error){
            if(data.nama_prodi_error['nama_prodi'] != '') $('#nama_prodi_error').html(data.nama_prodi_error['nama_prodi']); 
            else $('#nama_prodi_error').html('');
          }
          //Data fakultas berhasil disimpan
          if(data.success){
            formInput.trigger('reset');
            $('#modalAdd').modal('hide');
            $('#nama_prodi_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.success('Data prodi berhasil disimpan.');
          }
            
        }
        
      });

    });
    //-------------------------------------------------------------------

    //Menampilakan modal edit data prodi
    $('body').on('click', '.btn-editProdi', function () {
      const idProdi = $(this).attr('value');
      $.ajax({
        url : "<?php echo site_url('dataprodi/ajaxUpdate/')?>" + idProdi,
        type: "GET",
        dataType: "JSON", 
        success: function(data)
        {
          $('[name="idProdi"]').val(data.id);
          $('[name="nama_prodi2"]').val(data.nama_prodi);
          $('#modalEdit').modal('show');
        }        
      })

    });
    //-------------------------------------------------------------------

    //Save update data prodi
    $('#btn-updateDataProdi').on('click', function(){
      const formUpdate = $('#formUpdateDataProdi');
      
      $.ajax({
        url: "<?php echo base_url('dataprodi/update')?>",
        method: "POST",
        data: formUpdate.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data error 
          if(data.error){
            if(data.nama_prodi2_error['nama_prodi'] != '') $('#nama_prodi2_error').html(data.nama_prodi2_error['nama_prodi']); 
            else $('#nama_prodi2_error').html('');
          }
          //Data prodi berhasil disimpan
          if(data.success){
            formUpdate.trigger('reset');
            $('#modalEdit').modal('hide');
            $('#nama_prodi2_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.info('Data prodi berhasil diupdate.');
          }
            
        }
        
      });

    });
    //-------------------------------------------------------------------

    //Hapus data formasi prodi
    $('body').on('click', '.btn-deleteProdi', function (e) {
      e.preventDefault();
      const url = $(this).attr('href');

      Swal.fire({
        title: 'Hapus Data?',
        text: "Anda ingin menghapus data prodi ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: url,
            method: "POST",
            success: function (response) {
                $('#example1').DataTable().ajax.reload()
                toastr.info('Data prodi berhasil dihapus.');
            }
          });
        }
      });
      
    });
    //-------------------------------------------------------------------

  });

</script>
<?= $this->endSection() ?>


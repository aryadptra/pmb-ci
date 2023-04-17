<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Data Fakultas</h1>
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
                <h3 class="card-title">Tabel Data Fakultas</h3>

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
                    <th>Nama Fakultas</th>
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
  $(document).ready(function() {

    //Menampilkan data fakultas (dataTable server-side)
    $('#example1').DataTable({ 
      "responsive": true,
      "autoWidth": false,
      "processing" : true, 
      "serverSide" : true, 
      "order"    : [], 

      "ajax": {
        "url" : "datafakultas/ajaxDataFakultas",
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

    //Save input data fakultas
    $('#btn-saveDataFakultas').on('click', function(){
      const formInput = $('#formInputDataFakultas');
      
      $.ajax({
        url: "datafakultas/add",
        method: "POST",
        data: formInput.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data error 
          if(data.error){
            if(data.nama_fakultas_error['nama_fakultas'] != '') $('#nama_fakultas_error').html(data.nama_fakultas_error['nama_fakultas']); 
            else $('#nama_fakultas_error').html('');
          }
          //Data fakultas berhasil disimpan
          if(data.success){
            formInput.trigger('reset');
            $('#modalAdd').modal('hide');
            $('#nama_fakultas_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.success('Data fakultas berhasil disimpan.');
          }
            
        }
        
      });

    });
    //-------------------------------------------------------------------

    //Menampilakan modal edit data fakultas
    $('body').on('click', '.btn-editFakultas', function () {
      const idFakultas = $(this).attr('value');
      $.ajax({
        url : "datafakultas/ajaxUpdate/" + idFakultas,
        type: "GET",
        dataType: "JSON", 
        success: function(data)
        {
          $('[name="idFakultas"]').val(data.id);
          $('[name="nama_fakultas2"]').val(data.nama_fakultas);
          $('#modalEdit').modal('show');
        }        
      })

    });
    //-------------------------------------------------------------------

    //Save update data fakultas
    $('#btn-updateDataFakultas').on('click', function(){
      const formUpdate = $('#formUpdateDataFakultas');
      
      $.ajax({
        url: "datafakultas/update",
        method: "POST",
        data: formUpdate.serialize(),
        dataType: "JSON",
        success: function (data) {
          //Data error 
          if(data.error){
            if(data.nama_fakultas_error['nama_fakultas'] != '') $('#nama_fakultas2_error').html(data.nama_fakultas_error['nama_fakultas']); 
            else $('#nama_fakultas2_error').html('');
          }
          //Data fakultas berhasil disimpan
          if(data.success){
            formUpdate.trigger('reset');
            $('#modalEdit').modal('hide');
            $('#nama_fakultas2_error').html('');
            $('#example1').DataTable().ajax.reload();
            toastr.info('Data fakultas berhasil diupdate.');
          }
            
        }
        
      });

    });
    //-------------------------------------------------------------------

    //Hapus data formasi jabatan
    $('body').on('click', '.btn-deleteFakultas', function (e) {
      e.preventDefault();
      const url = $(this).attr('href');

      Swal.fire({
        title: 'Hapus Data?',
        text: "Anda ingin menghapus data fakultas ini?",
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
                toastr.info('Data fakultas berhasil dihapus.');
            }
          });
        }
      });
      
    });
    //-------------------------------------------------------------------

  });

</script>
<?= $this->endSection() ?>


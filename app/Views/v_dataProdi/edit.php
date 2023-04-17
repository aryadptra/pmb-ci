<div class="modal fade" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Data Prodi <?=$nama_fakultas; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdateDataProdi">
        <input type="hidden" name="idProdi">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_prodi">Nama Prodi</label>
            <input type="text" class="form-control" name="nama_prodi2" placeholder="Nama Prodi">
            <small id="nama_prodi2_error" class="text-danger"> </small>
          </div>
        </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn-updateDataProdi"class="btn btn-primary">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
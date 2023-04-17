<div class="modal fade" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Data Fakultas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdateDataFakultas">
        <div class="modal-body">
          <input type="hidden" name="idFakultas">
          <div class="form-group">
            <label for="nama_fakultas">Nama Fakultas</label>
            <input type="text" class="form-control" name="nama_fakultas2" placeholder="Nama Fakultas">
            <small id="nama_fakultas2_error" class="text-danger"> </small>
          </div>
        </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn-updateDataFakultas"class="btn btn-primary">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
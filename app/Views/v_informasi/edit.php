<div class="modal fade" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Informasi Pendaftaran Mahasiswa Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdateInformasi">
        <div class="modal-body">
          <input type="hidden" name="idInformasi">
          <div class="form-group">
            <label>Tanggal Pendaftaran</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type="text" name="tgl_pendaftaran" class="form-control float-right" id="reservation">
            </div>
            <small id="tgl_pendaftaran_error" class="text-danger"> </small>
          </div>
          <div class="form-group">
            <label>Tanggal Pengumuman Lulus Administrasi</label>
              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" name="tgl_pengumuman" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
              <small id="tgl_pengumuman_error" class="text-danger"> </small>
          </div>
        </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn-saveUpdateInformasi"class="btn btn-primary">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
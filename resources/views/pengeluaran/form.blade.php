<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="post" class="form-horizontal needs-validation" id="form-pengeluaran" novalidate>
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control id="deskripsi" name="deskripsi" placeholder="Deskripsi..." required autofocus>
                            <div class="invalid-feedback">
                                Deskripsi tidak boleh kosong!!!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control id="nominal" name="nominal" placeholder="Nominal" required autofocus>
                            <div class="invalid-feedback">
                                Nominal tidak boleh kosong!!!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

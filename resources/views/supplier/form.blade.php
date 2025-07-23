<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="post" class="form-horizontal needs-validation" id="form-supplier" novalidate>
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
                        <label for="nama" class="col-sm-3 col-form-label">Nama Supplier</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control id="nama" name="nama" placeholder="Masukkan Nama Supplier" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Nama Supplier
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control id="alamat" name="alamat" placeholder="Masukkan Alamat Supplier" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Alamat Supplier
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control id="telepon" name="telepon" placeholder="Masukkan Telepon Supplier" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Telepon Supplier
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

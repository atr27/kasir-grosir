<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('laporan.index') }}" method="get" class="form-horizontal needs-validation" id="form-pengeluaran" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tanggalAwal" class="col-sm-3 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tanggalAwal" name="tanggalAwal" placeholder="Tanggal Awal" required autofocus value="{{ request()->get('tanggalAwal') }}">
                            <div class="invalid-feedback">
                                Tanggal Awal tidak boleh kosong!!!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggalAkhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tanggalAkhir" name="tanggalAkhir" placeholder="Tanggal Akhir" required value="{{ request()->get('tanggalAkhir') }}">
                            <div class="invalid-feedback">
                                Tanggal Akhir tidak boleh kosong!!!
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

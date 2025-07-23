<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="post" class="form-horizontal needs-validation" id="form-produk" novalidate>
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
                        <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control id="nama_produk" name="nama_produk"
                                placeholder="Masukkan Nama Produk" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Nama Produk
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kategori" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-control id="id_kategori" name="id_kategori" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Pilih Kategori!!!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merek" class="col-sm-3 col-form-label">Merek</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control id="merek" name="merek"
                                placeholder="Masukkan Nama Merek" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Nama Merek
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_beli" class="col-sm-3 col-form-label">Harga Beli</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control id="harga_beli" name="harga_beli"
                                placeholder="Masukkan Harga Beli" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Harga Beli
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control id="harga_jual" name="harga_jual"
                                placeholder="Masukkan Harga Jual" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Harga Jual
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-sm-3 col-form-label">Diskon</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control id="diskon" name="diskon"
                                placeholder="Masukkan Diskon" required autofocus value="0">
                            <div class="invalid-feedback">
                                Masukkan Diskon
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control id="stok" name="stok"
                                placeholder="Masukkan Stok" required autofocus value="0">
                            <div class="invalid-feedback">
                                Masukkan Stok
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

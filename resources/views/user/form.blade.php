<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="post" class="form-horizontal needs-validation" id="form-User" novalidate
             oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Password tidak sesuai !!!" : "")'
        >
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
                        <label for="name" class="col-md-3 col-form-label">Nama User</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control id="name" name="name" placeholder="Masukkan Nama User" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Nama !!!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control id="email" name="email" placeholder="Masukkan Alamat Email" required autofocus>
                            <div class="invalid-feedback">
                                Masukkan Alamat Email !!!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control id="password" name="password" placeholder="Masukkan Password" required>
                            <div class="invalid-feedback">
                                Masukkan Password !!!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control id="password_confirmation" name="password_confirmation" placeholder="Masukkan Konfirmasi Password" required>
                            <div class="invalid-feedback">
                                Konfirmasi Password Tidak Sesuai !!!
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

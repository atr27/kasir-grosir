@extends('layouts.admin')

@section('title', __('Edit Profil'))

@section('breadcrumb')
    @parent
    <li class="active">@yield('title')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('user.updateProfil') }}" method="post" class="form-horizontal needs-validation"
                    id="form-profil"  oninput="password_confirmation.setCustomValidity(password_confirmation.value != password.value ? 'Password tidak sesuai !!!' : '')" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissable" style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Perubahan berhasil disimpan!</h5>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-offset-1 control-label">Nama</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="name" id="name" value="{{$profil->name}}">
                                <div class="invalid-feedback">
                                    Masukkan Nama User
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="foto" class="col-md-2 col-offset-1 control-label">Foto Profil</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="foto" id="foto" value=""
                                    onchange="preview('.tampil-foto', this.files[0])">
                                <div class="invalid-feedback">
                                    Masukkan Foto Profil
                                </div>
                                <br>
                                <div class="tampil-foto">
<<<<<<< HEAD
                                    <img src="{{ $profil->foto_url }}" width="150">
=======
                                    <img src="{{ url($profil->foto ?? '/') }}" width="150">
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordLama" class="col-md-2 col-form-label">Password Lama</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control id="passwordLama" name="passwordLama"
                                    placeholder="Masukkan Password Lama">
                                <div class="invalid-feedback">
                                    Masukkan Password !!!
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label">Password</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control id="password" name="password"
                                    placeholder="Masukkan Password">
                                <div class="invalid-feedback">
                                    Masukkan Password !!!
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control id="password_confirmation"
                                    name="password_confirmation" placeholder="Masukkan Konfirmasi Password">
                                <div class="invalid-feedback">
                                    Konfirmasi Password Tidak Sesuai !!!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#passwordLama').on('keyup', function() {
            if ($('#passwordLama').val() != '') {
                $('#password', '#password_confirmation').prop('required', true);
            } else {
                $('#password', '#password_confirmation').prop('required', false);
            }
        })

        $(function() {
            $('#form-profil').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        url: $('#form-profil').attr('action'),
                        type: $('#form-profil').attr('method'),
                        data: new FormData($('#form-profil')[0]),
                        async: false,
                        processData: false,
                        contentType: false,
                    }).done((response) => {
                        $('[name=name]').val(response.name);
<<<<<<< HEAD
                        $('.tampil-foto').html(`<img src="${response.foto_url}" width="150">`);
                        $('.image-profil').attr('src', response.foto_url);
=======
                        $('.tampil-foto').html(`<img src="{{ url('/') }}${response.foto}" width="150">`);
                        $('.image-profil').attr('src', `{{ url('/') }}${response.foto}`);
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
                        $('.alert').fadeIn();
                        setTimeout(() => {
                            $('.alert').fadeOut();
                        }, 3000);
                    })
                    .fail((errors) => {
                        if(errors.status == 422) {
                           alert(errors.responseJSON);
                        } else {
                            alert("Tidak dapat menyimpan data");
                            return;
                        }

                    });
                }
            })
        })

        $(function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endpush

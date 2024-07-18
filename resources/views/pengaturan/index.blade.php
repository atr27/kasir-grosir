@extends('layouts.admin')

@section('title', __('Pengaturan'))

@section('breadcrumb')
    @parent
    <li class="active">@yield('title')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('pengaturan.update') }}" method="post" class="form-horizontal needs-validation"
                    id="form-pengaturan" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissable" style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Perubahan berhasil disimpan!</h5>
                        </div>
                        <div class="form-group row">
                            <label for="nama_perusahaan" class="col-md-2 col-offset-1 control-label">Nama Perusahaan</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                                    value="" readonly>
                                <div class="invalid-feedback">
                                    Masukkan Nama Perusahaan
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-2 col-offset-1 control-label">Alamat</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control" name="alamat" id="alamat" value="" rows="5" required
                                    autofocus></textarea>
                                <div class="invalid-feedback">
                                    Masukkan Alamat Perusahaan
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-md-2 col-offset-1 control-label">Telepon</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="telepon" id="telepon" value=""
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Masukkan Nomor Telepon Perusahaan
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tipe_nota" class="col-md-2 col-offset-1 control-label">Tipe Nota</label>
                            <div class="col-md-2">
                                <select class="form-control" name="tipe_nota" id="tipe_nota" required>
                                    <option value="">Pilih Tipe Nota</option>
                                    <option value="1">Tipe Nota Kecil</option>
                                    <option value="2">Tipe Nota Besar</option>
                                </select>
                                <div class="invalid-feedback">
                                    Masukkan Tipe Nota
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diskon" class="col-md-2 col-offset-1 control-label">Diskon</label>
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="diskon" id="diskon" value=""
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Masukkan Besaran Diskon
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
        $(function() {
            showData();

            $('#form-pengaturan').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        url: $('#form-pengaturan').attr('action'),
                        type: $('#form-pengaturan').attr('method'),
                        data: new FormData($('#form-pengaturan')[0]),
                        async: false,
                        processData: false,
                        contentType: false,
                    }).done((response) => {
                        showData();
                        $('.alert').fadeIn();
                        setTimeout(() => {
                            $('.alert').fadeOut();
                        }, 3000);
                    }).fail((errors) => {
                        alert("Tidak dapat menyimpan data");
                        return;
                    });
                }
            })
        })

        function showData() {
            $.get('{{ route('pengaturan.show') }}')
                .done((response) => {
                    $('#nama_perusahaan').val(response.nama_perusahaan);
                    $('#alamat').val(response.alamat);
                    $('#telepon').val(response.telepon);
                    $('#tipe_nota').val(response.tipe_nota);
                    $('#diskon').val(response.diskon);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

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

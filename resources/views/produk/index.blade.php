@extends('layouts.admin')

@section('title', __('Produk'))

@section('breadcrumb')
    @parent
    <li class="active">@yield('title')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group">
                        <a onclick="addForm('{{ route('produk.store') }}')" class="btn btn-primary mr-2 rounded"><i
                                class="fa fa-plus"></i>Tambah Produk</a>
                        <a onclick="deleteSelected('{{ route('produk.delete-selected') }}')"
                            class="btn btn-danger mr-2 rounded">
                            <i class="fa fa-trash mr-2"></i>Hapus
                        </a>
                        <a onclick="cetakBarcode('{{ route('produk.cetak') }}')" class="btn btn-success rounded">
                            <i class="fa fa-barcode mr-2"></i>Cetak
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <form action="" method="post" class="form-produk">
                        @csrf
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" id="select_all"></th>
                                    <th width="5%">No</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Merek</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Diskon</th>
                                    <th>Stok</th>
                                    <th width="15%"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('produk.form')

@endsection

@push('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                "ajax": {
                    "url": "{{ route('produk.data') }}",

                },
                "columns": [{
                        data: 'select_all',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'nama_kategori'
                    },
                    {
                        data: 'merek'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'stok'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false,
                    }
                ],
            });
        });

        $(document).on('click', '#select_all', function() {
        $('input:checkbox').prop('checked', this.checked);
        });

        $('#modal-form').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('#modal-form form').attr('action'),
                            type: 'post',
                            data: $('#modal-form form').serialize()
                        })
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            $("#example1").DataTable().ajax.reload();
                        })
                        .fail((errors) => {
                            alert("Tidak dapat menyimpan data");
                            return;
                        });
                }
            })

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Produk');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Produk');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_produk]').val(response.nama_produk);
                    $('#modal-form [name=id_kategori]').val(response.id_kategori);
                    $('#modal-form [name=merek]').val(response.merek);
                    $('#modal-form [name=harga_beli]').val(response.harga_beli);
                    $('#modal-form [name=harga_jual]').val(response.harga_jual);
                    $('#modal-form [name=diskon]').val(response.diskon);
                    $('#modal-form [name=stok]').val(response.stok);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        $("#example1").DataTable().ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }


        (function() {
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

        function deleteSelected(url) {
            if ($('input[type=checkbox]:checked').length > 0) {
                if (confirm('Yakin ingin menghapus data terpilih?')) {
                    $.post(url, $('.form-produk').serialize())
                        .done((response) => {
                            $("#example1").DataTable().ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menghapus data');
                            return;
                        });
                } else {
                    return;
                }
            } else {
                alert('Pilih data yang ingin dihapus');
                return;
            }
        }

        function cetakBarcode(url) {
            if ($('input[type=checkbox]:checked').length < 1) {
                alert('Pilih data yang dicetak');
                return;
            } else if ($('input[type=checkbox]:checked').length < 3) {
                alert('Pilih minimal 3 data');
                return;
            } else {
                $('.form-produk').attr('action', url).attr('target', '_blank').submit();
            }
        }
    </script>
@endpush

@extends('layouts.admin')

@section('title', __('Supplier'))

@section('breadcrumb')
    @parent
    <li class="active">@yield('title')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a onclick="addForm('{{ route('supplier.store') }}')" class="btn btn-primary"><i
                            class="fa fa-plus"></i>Tambah Supplier</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('supplier.form')

@endsection

@push('js')
    <script>
                    $(function() {
                        $("#example1").DataTable({
                            "responsive": true,
                            "autoWidth": false,
                            "processing": true,
                            "ajax": {
                                "url": "{{ route('supplier.data') }}",
                            },
                            "columns": [{
                                    data: 'DT_RowIndex',
                                    searchable: false,
                                    sortable: false
                                },
                                {
                                    data: 'nama'
                                },
                                {
                                    data: 'alamat'
                                },
                                {
                                    data: 'telepon'
                                },
                                {
                                    data: 'aksi',
                                    searchable: false,
                                    sortable: false
                                }
                            ],
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
                    });


                    function addForm(url) {
                        $('#modal-form').modal('show');
                        $('#modal-form .modal-title').text('Tambah supplier');
                        $('#modal-form form')[0].reset();
                        $('#modal-form form').attr('action', url);
                        $('#modal-form [name=_method]').val('post');
                    }

                    function editForm(url) {
                        $('#modal-form').modal('show');
                        $('#modal-form .modal-title').text('Edit supplier');
                        $('#modal-form form')[0].reset();
                        $('#modal-form form').attr('action', url);
                        $('#modal-form [name=_method]').val('put');

                        $.get(url)
                            .done((response) => {
                                $('#modal-form [name=nama]').val(response.nama);
                                $('#modal-form [name=alamat]').val(response.alamat);
                                $('#modal-form [name=telepon]').val(response.telepon);
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
    </script>
@endpush

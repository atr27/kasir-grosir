@extends('layouts.admin')

@section('title', __('Member'))

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
                        <a onclick="addForm('{{ route('member.store') }}')" class="btn btn-primary mr-2 rounded"><i
                                class="fa fa-plus mr-2"></i>Tambah member</a>
                        <a onclick="cetakKartu('{{ route('member.cetak-kartu') }}')" class="btn btn-success rounded"><i
                                class="fa fa-id-card mr-2"></i>Cetak Kartu Member</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" class="form-member">
                        @csrf
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" id="select_all"></th>
                                    <th width="5%">No</th>
                                    <th>Kode Member</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
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

    @includeIf('member.form')
@endsection

@push('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                "ajax": {
                    "url": "{{ route('member.data') }}",
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
                        data: 'kode_member'
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

            $('#select_all').on('click', function() {
                $(':checkbox').prop('checked', this.checked);
            });
        });


        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Member');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Member');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama]').focus();

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

        function cetakKartu(url) {
            if ($(':checkbox:checked').length < 1) {
                alert('Tidak ada data yang dipilih');
                return;
            }  else if  ($(':checkbox:checked').length == 2 ) {
                alert('Pilih satu atau minimal 3 data yang dipilih untuk mencetak kartu');
                return;
            }
            else {
                $('.form-member').attr('action', url).attr('target', '_blank').submit();
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

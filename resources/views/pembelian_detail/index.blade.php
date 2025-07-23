@extends('layouts.admin')

@section('title', __('Transaksi Pembelian'))

@section('breadcrumb')
    @parent
    <li class="active">@yield('title')</li>
@endsection

@push('css')
    <style>
        .tampil-bayar {
            font-size: 5em;
            text-align: center;
            height: 120px;
        }

        .tampil-terbilang {
            padding: 10px;
            background: #f0f0f0;
        }

        #example1 tbody tr:last-child {
            display: none;
        }

        @media (max-width: 768px) {
            .tampil-bayar {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table>
                        <tr>
                            <td>Supplier</td>
                            <td>: {{ $supplier->nama }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $supplier->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>: {{ $supplier->telepon }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <form action="" method="post" class="form-pembelian">
                        @csrf
                        <div class="form-group row">
                            <label for="kode_produk" class="col-lg-1 py-1">Kode Produk</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="hidden" id="id_pembelian" name="id_pembelian" value="{{ $id_pembelian }}">
                                    <input type="hidden" id="id_produk" name="id_produk">
                                    <input type="text" class="form-control rounded ml-2" id="kode_produk"
                                        name="kode_produk">
                                    <span class="input-group-append">
                                        <button type="button" onclick="viewProduk()" class="btn btn-primary"
                                            type="button">
                                            <i class="fa fa-arrow-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tampil-bayar bg-warning">
                            </div>
                            <div class="tampil-terbilang">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('pembelian.store') }}" method="post" class="form-pembelian">
                                @csrf
                                <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">

                                <div class="form-group row mt-4">
                                    <label for="total_bayar" class="col-lg-2 control-label">Total</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="total_bayar" id="total_bayar"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control" name="diskon" id="diskon"
                                            value="{{ $diskon }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar_rp" class="col-lg-2 control-label">Bayar</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="bayar_rp" id="bayar_rp">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right mr-4 btn-simpan"><i
                            class="fa fa-save mr-2"></i>Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>

    @includeIf('pembelian_detail.produk')

@endsection

@push('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                "ajax": {
                    "url": "{{ route('pembelian_detail.data', $id_pembelian) }}",
                },
                "columns": [{
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
                        data: 'harga_beli'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    }
                ],
                dom: 'Brt',
                bSort: false
            }).on('draw.dt', function() {
                loadForm($('#diskon').val());
            });

            $('.tabel-produk').DataTable({
                "responsive": true,
                "autoWidth": false
            });

            $(document).on('input', '.edit-qty', function() {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    alert('Jumlah tidak boleh kurang dari 1');
                    $(this).val('1').select();
                    return;
                }

                if ($(this).val() > 10000) {
                    alert('Jumlah tidak boleh lebih dari 10000');
                    $(this).val('10000').select();
                    return;
                }

                $.post(`{{ url('/pembelian_detail') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah
                    })
                    .done((response) => {
                        $(this).on('mouseout', function() {
                            $("#example1").DataTable().ajax.reload(()=>loadForm($('#diskon').val()));
                        })
                    }).fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    })
            })

            $(document).on('input', '#diskon', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($(this).val());
            })

            $('.btn-simpan').on('click', function() {
                $('.form-pembelian').submit();
            })
        });

        function viewProduk(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Produk');
        }

        function hideProduk() {
            $('#modal-form').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            hideProduk();
            tambahProduk();
        }

        function tambahProduk() {
            $.post('{{ route('pembelian_detail.store') }}', $('.form-pembelian').serialize())
                .done((response) => {
                    $('#kode_produk').focus();
                    $("#example1").DataTable().ajax.reload(()=>loadForm($('#diskon').val()));
                })
                .fail((errors) => {
                    alert('Tidak dapat menambah data');
                    return;
                })
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        $("#example1").DataTable().ajax.reload(()=>loadForm($('#diskon').val()));
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }

        function loadForm(diskon = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/pembelian_detail/loadform') }}/${diskon}/${$('.total').text()}`)
                .done((response) => {
                    $('#total_bayar').val('Rp. ' + response.totalrp);
                    $('#bayar_rp').val('Rp. ' + response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text('Rp. ' + response.terbilang);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
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

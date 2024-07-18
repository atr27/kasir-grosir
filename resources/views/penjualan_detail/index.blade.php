@extends('layouts.admin')

@section('title', __('Transaksi Penjualan'))

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
                <div class="card-body">
                    <form action="" method="post" class="form-penjualan">
                        @csrf
                        <div class="form-group row">
                            <label for="kode_produk" class="col-lg-1 py-1">Kode Produk</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="hidden" id="id_penjualan" name="id_penjualan" value="{{ $id_penjualan }}">
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
                                <th>Diskon</th>
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
                            <form action="{{ route('transaksi.simpan')}}" method="post" class="form-penjualan">
                                @csrf
                                <input type="hidden" name="id_penjualan" value="{{ $id_penjualan }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">
                                <input type="hidden" name="id_member" id="id_member" value="{{ $memberSelected->id_member }}">

                                <div class="form-group row mt-4">
                                    <label for="total_bayar" class="col-lg-2 control-label">Total</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="total_bayar" id="total_bayar"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <label for="kode_member" class="col-lg-2 control-label d-flex">Member</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control rounded" id="kode_member"
                                                name="kode_member" value="{{ $memberSelected->kode_member }}" readonly>
                                            <span class="input-group-append">
                                                <button type="button" onclick="viewMember()" class="btn btn-primary"
                                                    type="button">
                                                    <i class="fa fa-arrow-right"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control" name="diskon" id="diskon"
                                            value="{{ ! empty($memberSelected->id_member) ? $diskon : 0 }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar_rp" class="col-lg-2 control-label">Bayar</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="bayar_rp" id="bayar_rp" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cash" class="col-lg-2 control-label">Cash</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="cash" id="cash" value="{{$penjualan->diterima ?? 0}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kembalian" class="col-lg-2 control-label d-flex mr-2">Kembalian</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="kembalian" id="kembalian" value="0" readonly>
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

    @includeIf('penjualan_detail.produk')
    @includeIf('penjualan_detail.member')

@endsection

@push('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                "ajax": {
                    "url": "{{route('transaksi.data', $id_penjualan)}}",
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
                        data: 'harga_jual'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'diskon'
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
                setTimeout(() => {
                    $('#cash').trigger('input');
                }, 300);
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

                $.post(`{{ url('/transaksi') }}/${id}`, {
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

            $('#cash').on('input', function() {
                if($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($('#diskon').val(),$(this).val());
            }).focus(function() {
                $(this).select();
            })

            $('.btn-simpan').on('click', function() {
                $('.form-penjualan').submit();
            })
        });

        function viewProduk(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Produk');
        }

        function viewMember(url) {
            $('#modal-member').modal('show');
            $('#modal-member .modal-title').text('Pilih Member');
        }

        function pilihMember(id, kode) {
            $('#id_member').val(id);
            $('#kode_member').val(kode);
            $('#diskon').val('{{ $diskon }}');
            loadForm($('#diskon').val());
            $('#cash').val(0).focus().select();
            hideMember();
        }

        function hideMember() {
            $('#modal-member').modal('hide');
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
            $.post('{{ route('transaksi.store') }}', $('.form-penjualan').serialize())
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

        function loadForm(diskon = 0, cash=0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/transaksi/loadform') }}/${diskon}/${$('.total').text()}/${cash}`)
                .done((response) => {
                    $('#total_bayar').val('Rp. ' + response.totalrp);
                    $('#bayar_rp').val('Rp. ' + response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Bayar: Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text(response.terbilang);
                    $('#kembalian').val('Rp. ' + response.kembalian);
                    if($('#cash').val() != 0) {
                        $('.tampil-bayar').text('Kembalian: Rp. ' + response.kembalian);
                        $('.tampil-terbilang').text(response.kembaliterbilang);
                    }
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

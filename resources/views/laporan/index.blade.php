@extends('layouts.admin')

@section('title', __('Laporan Pendapatan: ' . format_tanggal_indonesia($tanggalAwal, false) . ' s/d ' .
    format_tanggal_indonesia($tanggalAkhir, false)))

@section('breadcrumb')
    @parent
    <li class="active">Laporan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a onclick="updatePeriode()" class="btn btn-primary mr-2"><i class="fa fa-calendar mr-2"></i>Ubah
                        Periode</a>
                    @php
                    $cetakUrl = route('laporan.cetak', [$tanggalAwal, $tanggalAkhir]);
                    @endphp
                    <a onclick="{{ ($cetakUrl) ? 'window.open(\'' . $cetakUrl . '\', \'_blank\')' : 'void(0)' }}"
                        class="btn btn-warning"><i class="fa fa-file mr-2"></i>Cetak Laporan</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Penjualan</th>
                                <th>Pembelian</th>
                                <th>Pengeluaran</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('laporan.form')

@endsection

@push('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "processing": true,
                "ajax": {
                    "url": "{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}",
                },
                "columns": [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'penjualan'
                    },
                    {
                        data: 'pembelian'
                    },
                    {
                        data: 'pengeluaran'
                    },
                    {
                        data: 'pendapatan'
                    }
                ],
            });
        });


        function updatePeriode(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Ubah Periode Laporan');
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

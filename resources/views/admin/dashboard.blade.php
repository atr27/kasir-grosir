@extends('layouts.admin')

@section('title', __('Dashboard'))

@section('breadcrumb')
    @parent
    <li class="active">@yield('title')</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $kategori }}</h3>

                            <p>Total Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <a href="{{ route('kategori.index') }}" class="small-box-footer">Info lebih lanjut <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $produk }}</h3>

                            <p>Total Produk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <a href="{{ route('produk.index') }}" class="small-box-footer">Info lebih lanjut <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $member }}</h3>

                            <p>Total Member</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('member.index') }}" class="small-box-footer">Info lebih lanjut <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $supplier }}</h3>

                            <p>Total Supplier</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <a href="{{ route('supplier.index') }}" class="small-box-footer">Info lebih lanjut <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Grafik Laporan Pendapatan {{ format_tanggal_indonesia($tanggal_awal, false) }} s/d {{ format_tanggal_indonesia($tanggalAkhir, false) }} </h5>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="chart">
                                        <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="partials/dist/js/pages/dashboard2.js"></script>
    <script src="partials/plugins/chart.js/Chart.min.js"></script>
    <script>
        $(function() {
            var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
            var salesChartData = {
                labels: {{ json_encode($dataTanggal) }},
                datasets: [{
                        label: 'Data Pendapatan',
                        backgroundColor: 'rgba(255,99,71,0.9)',
                        borderColor: 'rgba(255,99,71,0.9)',
                        pointRadius: false,
                        pointColor: '#FF6347',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: {{ json_encode($dataPendapatan) }}
                    },
                ]
            }

            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }

            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: salesChartData,
                options: salesChartOptions
            })
        })
    </script>
@endpush

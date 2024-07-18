@extends('layouts.admin')

@section('title', __('Bukti Transaksi Penjualan'))

@section('breadcrumb')
    @parent
    <li class="active">@yield('title')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body responsive p-4">
                    <div class="alert alert-success alert-dismissible fade show">
                        <h5 class="alert-heading mt-1"><i class="icon fas fa-check"></i>Data berhasil disimpan</h5>
                        <button type="button" class="close mt-1" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div class="card-footer">
                        @if ($pengaturan->tipe_nota == 1)
                            <button class="btn btn-primary"
                                onclick="notaKecil('{{ route('transaksi.notaKecil') }}', 'Nota Kecil')"><i
                                    class="fas fa-print mr-2"></i>Cetak</button>
                        @else
                            <button class="btn btn-primary"
                                onclick="notaBesar('{{ route('transaksi.notaBesar') }}', 'Nota Besar')"><i
                                    class="fas fa-print mr-2"></i>Cetak</button>
                        @endif
                        <a href="{{ route('transaksi.baru') }}" class="btn btn-info">Transaksi Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function notaKecil(url, title) {
            popupCenter(url, title, 625, 500);
        }

        function notaBesar(url, title) {
            popupCenter(url, title, 900, 675);
        }

        function popupCenter (url,title,w,h) {
            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document
                .documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document
                .documentElement.clientHeight : screen.height;

            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, title,
                `
                scrollbars=yes,
                width   = ${w / systemZoom},
                height  = ${h / systemZoom},
                top     = ${top},
                left    = ${left}
                `
            )
            if (window.focus) newWindow.focus();
        }
    </script>
@endpush

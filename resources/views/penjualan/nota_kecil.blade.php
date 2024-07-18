<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Kecil</title>
    <?php
    $style = '
        <style>
              * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 0;
                size: 75mm
    ';
    ?>
    <?php
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm; }' : '}';
    ?>
    <?php
    $style .= '
                 html, body {
                     width: 75mm;
                 }
                .btn-print {
                    display: none;
                }
            }
        }
    </style>
    ';
    ?>

    {!! $style  !!}
</head>

<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: 1rem;" onclick="window.print()">Print</button>
    <div class="text-center">
        <h3 style="margin-bottom: 5px">{{ strtoupper($pengaturan->nama_perusahaan) }}</h3>
        <p>{{ strtoupper($pengaturan->alamat) }}</p>
    </div>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
        <p style="float: right">{{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both"></div>
    <p>No. Nota: {{ tambahNolDepan($penjualan->id_penjualan) }}</p>
    <p class="text-center">========================================</p>
    <table width="100%" style="border: 0">
        @foreach ($detail as $item)
            <tr>
                <td colspan="3">{{ $item->produk->nama_produk }}</td>
            </tr>
            <tr>
                <td>{{ $item->jumlah }} x {{ format_rupiah($item->harga_jual) }}</td>
                <td></td>
                <td class="text-right">{{ format_rupiah($item->jumlah * $item->harga_jual) }}</td>
            </tr>
        @endforeach
    </table>

    <p class="text-center">-------------------------------------</p>
    <table width="100%" style="border: 0">
        <tr>
            <td>Total Harga:</td>
            <td class="text-right">{{ format_rupiah($penjualan->total_harga) }}</td>
        </tr>
        <tr>
            <td>Total Item:</td>
            <td class="text-right">{{ format_rupiah($penjualan->total_item) }}</td>
        </tr>
        <tr>
            <td>Diskon:</td>
            <td class="text-right">{{ format_rupiah($penjualan->diskon) }}</td>
        </tr>
        <tr>
            <td>Total Bayar:</td>
            <td class="text-right">{{ format_rupiah($penjualan->bayar) }}</td>
        </tr>
        <tr>
            <td>Diterima:</td>
            <td class="text-right">{{ format_rupiah($penjualan->diterima) }}</td>
        </tr>
        <tr>
            <td>Kembalian:</td>
            <td class="text-right">{{ format_rupiah($penjualan->diterima - $penjualan->bayar) }}</td>
        </tr>
    </table>

    <p class="text-center">========================================</p>
    <p class="text-center">-- TERIMA KASIH --</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight);
        document.cookie = 'innerHeight=; expires=' + new Date().toUTCString() + ';path=/';
        document.cookie = 'innerHeight='+ (height + 50) * 0.264583;

    </script>
</body>

</html>

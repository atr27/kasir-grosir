<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Besar</title>
    <style>
        table td {
            font-size: 14px;
        }

        table.data td,
        table.data th {
            border: 1px solid black;
            padding: 5px;
        }

        table.data {
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <td rowspan="5" width="60%">
                <img src="logoLaravel.png" alt="Laravel Store" width="120"
                    style="margin-right: 2px; margin-bottom: 2px">
                <p><b>{{ strtoupper($pengaturan->nama_perusahaan) }}</b></p>
                <p>{{ $pengaturan->alamat }}</p>
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ format_tanggal_indonesia($penjualan->created_at) }}</td>
        </tr>
        <tr>
            <td>Kode Nota</td>
            <td>: {{ tambahNolDepan($penjualan->id_penjualan) }}</td>
        </tr>
        <tr>
            <td>Member</td>
            <td>: {{ $penjualan->member->kode_member ?? '-' }}</td>
        </tr>
    </table>
    <table class="data" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Barang</th>
                <th>Harga Satuan</th>
                <th>Qty</th>
                <th>Diskon</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->produk->kode_produk }}</td>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td class="text-right">{{ format_rupiah($item->harga_jual) }}</td>
                    <td class="text-right">{{ format_rupiah($item->jumlah) }}</td>
                    <td class="text-right">{{ $item->diskon }}</td>
                    <td class="text-right">{{ format_rupiah($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="border-bottom: none"></td>
                <td class="text-right">Total:</td>
                <td class="text-right">{{ format_rupiah($penjualan->total_harga) }}</td>
            </tr>
            <tr>
                <td colspan="5" style="border-top: none; border-bottom:none"></td>
                <td class="text-right">Total Item:</td>
                <td class="text-right">{{ format_rupiah($penjualan->total_item) }}</td>
            </tr>
            <tr>
                <td colspan="5" style="border-top: none; border-bottom:none"></td>
                <td class="text-right">Diskon:</td>
                <td class="text-right">{{ format_rupiah($penjualan->diskon) }}</td>
            </tr>
            <tr>
                <td colspan="5" style="border-top: none; border-bottom:none"></td>
                <td class="text-right">Total Bayar:</td>
                <td class="text-right">{{ format_rupiah($penjualan->bayar) }}</td>
            </tr>
            <tr>
                <td colspan="5" style="border-top: none; border-bottom:none"></td>
                <td class="text-right">Diterima:</td>
                <td class="text-right">{{ format_rupiah($penjualan->diterima) }}</td>
            </tr>
            <tr>
                <td colspan="5" style="border-top: none"></td>
                <td class="text-right">Kembalian:</td>
                <td class="text-right">{{ format_rupiah($penjualan->diterima - $penjualan->bayar) }}</td>
            </tr>
        </tfoot>
    </table>
    <table width="100%">
        <tr>
            <td><b>Terima kasih telah berbelanja di toko grosir kami</b></td>
            <td class="text-center">
                Kasir :
                <br>
                <br>
                {{ strtoupper(auth()->user()->name) }}
            </td>
        </tr>
    </table>
</body>

</html>

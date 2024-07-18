<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            @foreach ($data as $produk)
                <td style="border: 1px solid black;">
                    <p class="text-center" style="display: flex; flex:wrap">
                        {{ $produk->merek }} - Rp. {{ format_rupiah($produk->harga_jual) }}
                    </p>
                    <div style="position: relative; padding: 10px">
                        <p style="position: absolute; top: 0; right: 0">{!! DNS1D::getBarcodeHTML($produk->kode_produk, 'C39', 1, 70) !!}</p>
                    </div>
                </td>
                @if ($no++ % 4 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>

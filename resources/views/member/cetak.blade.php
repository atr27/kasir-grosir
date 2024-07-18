<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Member</title>
    <style>
        .box {
            position: relative;
        }

        .logo {
            position: absolute;
            top: 3pt;
            right: 0pt;
            font-size: 16pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #fff !important;
        }

        .logo p {
            text-align: right;
            margin-right: 16pt;
            margin-top: 24pt;
        }

        .logo img {
            position: absolute;
            margin-top: -5pt;
            width: 40px;
            height: 40px;
            right: 16pt;
        }

        .nama {
            position: absolute;
            top: 100pt;
            right: 60pt;
            font-size: 16pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #fff !important;
        }

        .telepon {
            position: absolute;
            top: 120pt;
            left: 5pt;
            color: #fff;
        }

        .barcode {
            position: absolute;
            top: 105pt;
            right: 5pt;
            font-size: 16pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <section style="border: 1px solid white">
        <table width="100%">
            @foreach ($dataMember as $key => $data)
                <tr>
                    @foreach ($data as $item)
                        <td class="text-center">
                            <div class="box">
                                <img src="namecard.jpg" alt="card" width="100%">
                                <div class="logo">
                                    <p>{{$pengaturan->nama_perusahaan}}</p>
                                    <img src="logoLaravel.png" alt="logo">
                                </div>
                                <div class="nama">{{ $item->nama }}</div>
                                <div class="telepon">{{ $item->telepon }}</div>
                                <div class="barcode text-left">
                                    {!! DNS2D::getBarcodeHTML($item->kode_member, 'QRCODE', 2, 2, 'white') !!}
                                </div>
                            </div>
                        </td>
                        @if (count($dataMember) == 1)
                            <td class="text-center" width="50%"></td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>

    </section>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Dokumen Laporan</title>
    <link rel="stylesheet" href="partials/dist/css/adminlte.min.css">
</head>
<body>
    <h3 class="text-center">Laporan Pendapatan Laravel Store</h3>
    <h4 class="text-center">Periode {{ format_tanggal_indonesia($awal, false) }} - {{ format_tanggal_indonesia($akhir, false) }} </h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Penjualan</th>
                <th>Pembelian</th>
                <th>Pengeluaran</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $col)
                        <td>{{ $col }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

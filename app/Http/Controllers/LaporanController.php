<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
       $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
       $tanggalAkhir = date('Y-m-d');

       if ($request->has('tanggalAwal') && $request->has('tanggalAkhir')) {
           $tanggalAwal = $request->tanggalAwal;
           $tanggalAkhir = $request->tanggalAkhir;
       }

       return view('laporan.index', compact('tanggalAwal','tanggalAkhir'));
    }

    public function getData($tanggalAwal, $tanggalAkhir)
    {
        $no = 1;
        $data = array();
        $pendapatan = 0;
        $total_pendapatan = 0;

        while (strtotime($tanggalAwal) <= strtotime($tanggalAkhir)) {
            $tanggal = $tanggalAwal;
            $tanggalAwal = date('Y-m-d', strtotime("+1 days", strtotime($tanggalAwal)));

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $total_pengeluran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');
            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluran;
            $total_pendapatan += $pendapatan;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = format_tanggal_indonesia($tanggal, false);
            $row['penjualan'] = format_rupiah($total_penjualan);
            $row['pembelian'] = format_rupiah($total_pembelian);
            $row['pengeluaran'] = format_rupiah($total_pengeluran);
            $row['pendapatan'] = format_rupiah($pendapatan);

            $data[] = $row;
        }

        $data[]= [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'penjualan' => '',
            'pembelian' => '',
            'pengeluaran' => 'Total Pendapatan',
            'pendapatan' => format_rupiah($total_pendapatan),
        ];

        return $data;
    }

    public function data($tanggalAwal, $tanggalAkhir)
    {
         $data = $this->getData($tanggalAwal, $tanggalAkhir);

         return datatables()
         ->of($data)
         ->make(true);
    }

    public function cetak($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);

        $pdf = Pdf::loadView('laporan.cetak', compact('data', 'awal', 'akhir'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan Pendapatan '.$awal.'-'.$akhir.'.pdf');
    }
}

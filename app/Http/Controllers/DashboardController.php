<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Member;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Kategori::count();
        $produk = Produk::count();
        $supplier = Supplier::count();
        $member = Member::count();

        $tanggal_awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));

        $tanggalAwal = date('Y-m-01');
        $tanggalAkhir = date('Y-m-d');

        $dataTanggal = array();
        $dataPendapatan = array();

            while (strtotime($tanggalAwal) <= strtotime($tanggalAkhir)) {
                $dataTanggal[] = (int) substr($tanggalAwal, 8, 2);

                $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggalAwal%")->sum('bayar');
                $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggalAwal%")->sum('bayar');
                $total_pengeluran = Pengeluaran::where('created_at', 'LIKE', "%$tanggalAwal%")->sum('nominal');
                $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluran;
                $dataPendapatan[] += $pendapatan;

                $tanggalAwal = date("Y-m-d", strtotime("+1 day", strtotime($tanggalAwal)));
            }

        if(auth()->user()->level==1){
            return view('admin.dashboard', compact('kategori', 'produk', 'supplier', 'member', 'tanggal_awal', 'tanggalAkhir', 'dataPendapatan', 'dataTanggal'));
        } else {
            return view('kasir.dashboard');
        }

    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan.index');
    }

    public function data()
    {
        $penjualan = Penjualan::with(['member', 'user'])->orderBy('id_penjualan', 'desc')->get();

        return datatables()
        ->of($penjualan)
        ->addIndexColumn()
        ->addColumn('total_item', function ($penjualan) {
            return format_rupiah($penjualan->total_item);
        })
        ->addColumn('total_harga', function ($penjualan) {
            return 'Rp. '.format_rupiah($penjualan->total_harga);
        })
        ->addColumn('bayar', function ($penjualan) {
            return 'Rp. '.format_rupiah($penjualan->bayar);
        })
        ->addColumn('created_at', function ($penjualan) {
            return format_tanggal_indonesia($penjualan->created_at);
        })
        ->addColumn('kode_member', function ($penjualan) {
            return $penjualan->member ? '<span class="badge badge-success">'.$penjualan->member->kode_member.'</span>' : '<span class="badge badge-danger">Bukan Member</span>';
        })
        ->editColumn('diskon', function ($penjualan) {
            return $penjualan->diskon . ' %';
        })
        ->addColumn('kasir', function ($penjualan) {
            return $penjualan->user->name ?? '';
        })
        ->addColumn('aksi', function ($penjualan) {
            return '
                <button onclick="viewData(`' . route('penjualan.show', $penjualan->id_penjualan) . '`)" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-eye"></i></button>
                <button onclick="deleteData(`' . route('penjualan.delete', $penjualan->id_penjualan) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            ';
        })->rawColumns(['aksi', 'kode_member'])->make(true);
    }

    public function create()
    {
        $penjualan = new Penjualan();
        $penjualan->id_member = null;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->id_user = auth()->id();
        $penjualan->save();

        session([
            'id_penjualan' => $penjualan->id_penjualan
        ]);

        return redirect()->route('transaksi.index');
    }

    public function store(Request $request)
    {
        $penjualan = Penjualan::findOrFail($request->id_penjualan);
        $penjualan->id_member = $request->id_member;
        $penjualan->total_item = $request->total_item;
        $penjualan->total_harga = $request->total;
        $penjualan->diskon = $request->diskon;
        $penjualan->bayar = $request->bayar;
        $penjualan->diterima = $request->cash;
        $penjualan->update();

        $detail = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            $produk->stok -= $item->jumlah;
            $produk->update();
        }

        return redirect()->route('transaksi.print');
    }

    public function show($id)
    {
        $detail = PenjualanDetail::with('produk')->where('id_penjualan', $id)->get();

        return datatables()
        ->of($detail)
        ->addIndexColumn()
        ->addColumn('kode_produk', function ($detail) {
            return '<span class="badge badge-success">'.$detail->produk->kode_produk.'</span>';
        })
        ->addColumn('nama_produk', function ($detail) {
            return $detail->produk->nama_produk;
        })
        ->addColumn('harga_jual', function ($detail) {
            return 'Rp. '.format_rupiah($detail->produk->harga_jual);
        })
        ->addColumn('jumlah', function ($detail) {
            return format_rupiah($detail->jumlah);
        })
        ->addColumn('subtotal', function ($detail) {
            return 'Rp. '.format_rupiah($detail->subtotal);
        })
        ->rawColumns(['kode_produk'])
        ->make(true);
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);
        $detail = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $item->delete();
        }
        $penjualan->delete();
        return response(null, 204);
    }

    public function print ()
    {
        $pengaturan = Pengaturan::first();
        return view('penjualan.print', compact('pengaturan'));
    }

    public function notaKecil ()
    {
        $pengaturan = Pengaturan::first();
        $penjualan = Penjualan::findOrFail(session('id_penjualan'));
        if (! $penjualan){
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')->where('id_penjualan', session('id_penjualan'))->get();
        return view('penjualan.nota_kecil', compact('pengaturan', 'penjualan', 'detail'));
    }

    public function notaBesar ()
    {
        $pengaturan = Pengaturan::first();
        $penjualan = Penjualan::findOrFail(session('id_penjualan'));
        if (! $penjualan){
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')->where('id_penjualan', session('id_penjualan'))->get();
        $pdf = Pdf::loadview('penjualan.nota_besar', compact('pengaturan', 'penjualan', 'detail'));
<<<<<<< HEAD
        $pdf->setPaper(0,0,609,440,'portrait');
=======
        $pdf->setPaper(0,0,609,440,'potrait');
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
        return $pdf->stream('Transaksi-'.date('Y-m-d H:i:s').'.pdf');
    }
}

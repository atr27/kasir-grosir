<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Pengaturan;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanDetailController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('nama_produk')->get();
        $member = Member::orderBy('nama')->get();
        $diskon = Pengaturan::first()->diskon ?? 0;
        $id_penjualan = session('id_penjualan');
        $penjualan = Penjualan::with('member')->find($id_penjualan);
        $memberSelected = $penjualan->member ?? new Member();
        
        return view('penjualan_detail.index', compact('id_penjualan', 'produk', 'member', 'diskon', 'memberSelected', 'penjualan'));
    }

    public function data($id)
    {
        $penjualan_detail = PenjualanDetail::with('produk')->where('id_penjualan', $id)->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($penjualan_detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="badge bg-primary">' . $item->produk['kode_produk'] . '</span>';
            $row['nama_produk'] = $item->produk['nama_produk'];
            $row['harga_jual'] = 'Rp '.format_rupiah($item->harga_jual);
            $row['jumlah'] = '<input type="number" class="form-control edit-qty" data-id="' . $item->id_penjualan_detail . '"value="' . $item->jumlah . '">';
            $row['diskon'] = $item->diskon . ' %';
            $row['subtotal'] = 'Rp '.format_rupiah($item->subtotal);
            $row['aksi'] = '  <button onclick="deleteData(`' . route('transaksi.destroy', $item->id_penjualan_detail) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
            $total += $item->harga_jual * $item->jumlah;
            $total_item += $item->jumlah;
        }

        $data[] =
            [
                'kode_produk'   => '
                    <div class="total" hidden>' . $total . '</div>
                    <div class="total_item" hidden>' . $total_item . '</div>',
                'nama_produk'  =>  '',
                'harga_jual'  => '',
                'jumlah' => '',
                'diskon' => '',
                'subtotal' => '',
                'aksi' => '',
            ];


        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_produk', 'jumlah'])->make(true);
    }

    public function store(Request $request)
    {
        $produk = Produk::where('id_produk', $request->id_produk)->first();
        if (!$produk) {
            return response()->json('Produk tidak ditemukan', 404);
        }
        $detail = new PenjualanDetail();
        $detail->id_penjualan = $request->id_penjualan;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_jual = $produk->harga_jual;
        $detail->jumlah = 1;
        $detail->diskon = 0;
        $detail->subtotal = $produk->harga_jual;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update($id, Request $request)
    {
        $detail = PenjualanDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_jual * $request->jumlah;
        $detail->update();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function destroy($id)
    {
        $penjualan_detail = PenjualanDetail::find($id);
        $penjualan_detail->delete();
        return response(null, 204);
    }

    public function loadForm($diskon=0, $total, $cash)
    {
        $bayar = $total - ($diskon / 100 * $total);
        $kembali = ($cash != 0) ? $cash - $bayar : 0;
        $data = [
            'totalrp' => format_rupiah($total),
            'bayar' => $bayar,
            'bayarrp' => format_rupiah($bayar),
            'terbilang' => ucwords(terbilang($bayar)) . ' Rupiah',
            'kembalian' => format_rupiah($kembali),
            'kembaliterbilang' => ucwords(terbilang($kembali)) . ' Rupiah',
        ];
        return response()->json($data);
    }

}

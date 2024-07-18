<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class PembelianDetailController extends Controller
{
    public function index()
    {
        $id_pembelian = session('id_pembelian');
        $produk = Produk::orderBy('nama_produk')->get();
        $supplier = Supplier::find(session('id_supplier'));
        $diskon = Pembelian::find($id_pembelian)->diskon ?? 0;

        if (!$supplier) {
            return redirect()->route('pembelian.index');
        }

        return view('pembelian_detail.index', compact('id_pembelian', 'supplier', 'produk', 'diskon'));
    }

    public function data($id)
    {
        $pembelian_detail = PembelianDetail::with('produk')->where('id_pembelian', $id)->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($pembelian_detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="badge bg-primary">' . $item->produk['kode_produk'] . '</span>';
            $row['nama_produk'] = $item->produk['nama_produk'];
            $row['harga_beli'] = 'Rp '.format_rupiah($item->harga_beli);
            $row['jumlah'] = '<input type="number" class="form-control edit-qty" data-id="' . $item->id_pembelian_detail . '"value="' . $item->jumlah . '">';
            $row['subtotal'] = 'Rp '.format_rupiah($item->subtotal);
            $row['aksi'] = '  <button onclick="deleteData(`' . route('pembelian_detail.destroy', $item->id_pembelian_detail) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
            $data[] = $row;
            $total += $item->harga_beli * $item->jumlah;
            $total_item += $item->jumlah;
        }

        $data[] =
            [
                'kode_produk'   => '
                    <div class="total" hidden>' . $total . '</div>
                    <div class="total_item" hidden>' . $total_item . '</div>',
                'nama_produk'  =>  '',
                'harga_beli'  => '',
                'jumlah' => '',
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
        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update($id, Request $request)
    {
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
        return response()->json('Data berhasil disimpan', 200);
    }


    public function destroy($id)
    {
        $pembelian_detail = PembelianDetail::find($id);
        $pembelian_detail->delete();
        return response(null, 204);
    }

    public function loadForm($diskon, $total)
    {
        $bayar = $total - ($diskon / 100 * $total);
        $data = [
            'totalrp' => format_rupiah($total),
            'bayar' => $bayar,
            'bayarrp' => format_rupiah($bayar),
            'terbilang' => ucwords(terbilang($bayar)) . ' Rupiah',
        ];
        return response()->json($data);
    }
}

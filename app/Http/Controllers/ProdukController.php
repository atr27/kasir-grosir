<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        return view('produk.index', compact('kategori'));
    }

    public function data()
    {
        $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
            ->select('produk.*', 'nama_kategori')
            ->orderBy('kode_produk', 'ASC')->get();

        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '<input type="checkbox" name="id_produk[]" value="' . $produk->id_produk . '">';
            })
            ->addColumn('kode_produk', function ($produk) {
                return '<span class="badge badge-success">' . $produk->kode_produk . '</span>';
            })
            ->addColumn('harga_beli', function ($produk) {
                return format_rupiah($produk->harga_beli);
            })
            ->addColumn('harga_jual', function ($produk) {
                return format_rupiah($produk->harga_jual);
            })
            ->addColumn('stok', function ($produk) {
                return format_rupiah($produk->stok);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <button type="button" onclick="editForm(`' . route('produk.update', $produk->id_produk) . '`)" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button>
                <button type="button" onclick="deleteData(`' . route('produk.destroy', $produk->id_produk) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            ';
            })->rawColumns(['aksi', 'kode_produk', 'select_all'])->make(true);
    }

    public function show($id)
    {
        $produk = Produk::find($id);
        return response()->json($produk);
    }

    public function store(Request $request)
    {
        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->id_kategori = $request->id_kategori;
        $produk->merek = $request->merek;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->diskon = $request->diskon;
        $produk->stok = $request->stok;
        $produk->save();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->id_kategori = $request->id_kategori;
        $produk->merek = $request->merek;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->diskon = $request->diskon;
        $produk->stok = $request->stok;
        $produk->update();
        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
       $data = array();

       foreach ($request->id_produk as $id) {
           $produk = Produk::find($id);
           if ($produk) {
               $data[] = $produk;
           }
       }

       $no = 1;
       $pdf = Pdf::loadview('produk.barcode', compact('data', 'no'));
       $pdf->setPaper('a4','potrait');
       return $pdf->stream('produk.pdf');

    }
}

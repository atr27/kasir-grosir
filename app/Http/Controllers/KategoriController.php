<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index');
    }

    public function data()
    {
        $kategori = Kategori::orderBy('id_kategori', 'asc')->get();

        return datatables()->of($kategori)->addIndexColumn()->addColumn('aksi', function ($kategori) {
            return '
                <button onclick="editForm(`' . route('kategori.update', $kategori->id_kategori) . '`)" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`' . route('kategori.destroy', $kategori->id_kategori) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            ';
        })->rawColumns(['aksi'])->make(true);
    }

    public function show ($id)
    {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();
        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return response(null, 204);
    }
}

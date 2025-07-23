<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        return view('pengeluaran.index');
    }

    public function data()
    {
        $pengeluaran = Pengeluaran::orderBy('id_pengeluaran', 'asc')->get();

        return datatables()->of($pengeluaran)->addIndexColumn()
        ->addColumn('created_at', function ($pengeluaran) {
            return format_tanggal_indonesia($pengeluaran->created_at);
        })
        ->addColumn('nominal', function ($pengeluaran) {
            return 'Rp. '.format_rupiah($pengeluaran->nominal);
        })
        ->addColumn('aksi', function ($pengeluaran) {
            return '
                <button onclick="editForm(`' . route('pengeluaran.update', $pengeluaran->id_pengeluaran) . '`)" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`' . route('pengeluaran.destroy', $pengeluaran->id_pengeluaran) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            ';
        })->rawColumns(['aksi'])->make(true);
    }

    public function show ($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return response()->json($pengeluaran);
    }

    public function store(Request $request)
    {
        $pengeluaran = new Pengeluaran();
        $pengeluaran->deskripsi = $request->deskripsi;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->save();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->deskripsi = $request->deskripsi;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->update();
        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return response(null, 204);
    }
}

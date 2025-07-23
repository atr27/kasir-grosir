<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.index');
    }

    public function data()
    {
        $supplier = Supplier::orderBy('id_supplier', 'asc')->get();

        return datatables()->of($supplier)->addIndexColumn()->addColumn('aksi', function ($supplier) {
            return '
                <button onclick="editForm(`' . route('supplier.update', $supplier->id_supplier) . '`)" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`' . route('supplier.destroy', $supplier->id_supplier) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            ';
        })->rawColumns(['aksi'])->make(true);
    }

    public function show ($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function store(Request $request)
    {
        $supplier = new Supplier();
        $supplier->nama = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->telepon = $request->telepon;
        $supplier->save();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->nama = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->telepon = $request->telepon;
        $supplier->update();
        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return response(null, 204);
    }
}

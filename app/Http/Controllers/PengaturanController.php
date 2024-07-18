<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index ()
    {
        return view('pengaturan.index');
    }

    public function show()
    {
        return Pengaturan::first();
    }

    public function update(Request $request)
    {
        $pengaturan = Pengaturan::first();
        $pengaturan->nama_perusahaan = $request->nama_perusahaan;
        $pengaturan->alamat = $request->alamat;
        $pengaturan->telepon = $request->telepon;
        $pengaturan->tipe_nota = $request->tipe_nota;
        $pengaturan->diskon = $request->diskon;
        $pengaturan->update();
        return response()->json('Data berhasil disimpan', 200);
    }
}

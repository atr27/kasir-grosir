<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Pengaturan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('member.index');
    }

    public function data()
    {
        $member = Member::orderBy('kode_member')->get();

        return datatables()->of($member)
            ->addColumn('select_all', function ($member) {
                return '<input type="checkbox" name="id_member[]" value="' . $member->id_member . '">';
            })
            ->addIndexColumn()
            ->addColumn('kode_member', function ($member) {
                return '<span class="badge badge-success">' . $member->kode_member . '</span>';
            })
            ->addColumn('aksi', function ($member) {
                return '
                <button type="button" onclick="editForm(`' . route('member.update', $member->id_member) . '`)" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button>
                <button type="button" onclick="deleteData(`' . route('member.destroy', $member->id_member) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            ';
            })->rawColumns(['aksi', 'kode_member', 'select_all'])->make(true);
    }

    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }

    public function store(Request $request)
    {
        $member = new Member();
        $member->create($request->all());
        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $member->update($request->all());
        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return response(null, 204);
    }

    public function cetakKartu(Request $request)
    {
        $dataMember = collect(array());

        foreach ($request->id_member as $id) {
            $member = Member::find($id);
            $dataMember[] = $member;
        }

        $dataMember = $dataMember->chunk(2);
        $pengaturan = Pengaturan::first();
        $no = 1;
        $pdf = Pdf::loadview('member.cetak', compact('dataMember', 'no', 'pengaturan'));
        $pdf->setPaper(array(0, 0, 566.93, 750.39), 'potrait');
        return $pdf->stream('member.pdf');
    }
}

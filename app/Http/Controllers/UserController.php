<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function data()
    {
        $user = User::isNotAdmin()->orderBy('id', 'asc')->get();


        return datatables()->of($user)->addIndexColumn()->addColumn('aksi', function ($user) {
            return '
                <button onclick="editForm(`' . route('user.update', $user->id) . '`)" class="btn btn-xs btn-warning btn-flat"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`' . route('user.destroy', $user->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            ';
        })->rawColumns(['aksi'])->make(true);
    }

    public function show ($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        $user->foto = '/partials/dist/img/avatar5.png';
        $user->save();
        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->update();
        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response(null, 204);
    }

    public function profil()
    {
        $profil = auth()->user();
        return view('user.profil',  compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        if($request->has('password') && $request->password != '') {
            if(Hash::check($request->passwordLama, $user->password)) {
                if($request->password == $request->password_confirmation) {
                    $user->password = bcrypt($request->password);
                } else {
                    return response()->json('Password baru tidak sesuai', 422);
                }
            } else {
                return response()->json('Password lama tidak sesuai', 422);
            }
        }

        if ($request->hasFile('foto')) {
            $file =  $request->file('foto');
            $nama  =  'profil-' . $user->name . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('partials/dist/img'), $nama);
            $user->foto = "/partials/dist/img/$nama";
        }

        $user->update();
        return response()->json($user,  200);
    }
}

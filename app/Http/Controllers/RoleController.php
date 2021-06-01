<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $data['roles'] = Role::all();
        return view('role.index')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5'
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save() ?
            Alert::success('Sukses!', 'Berhasil simpan data.') : Alert::error('Gagal!', 'Gagal simpan data');

        return redirect()->back();
    }
}

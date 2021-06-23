<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        return view('user.setting-account');
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name'  => 'required|max:100',
            'password' => 'nullable|min:5|same:r_password'
        ]);

        $user = User::find($request->user()->id);

        if ($user->email != $request->email) {
            $cek = User::where('email', $request->email)->count();
            if ($cek > 0) {
                Alert::error('Error!', 'Maaf email sudah pernah terdaftar.');
                return redirect()->back();
            }
        }

        $data = [
            'email' => $request->email,
            'name' => $request->name
        ];

        if ($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);

        Alert::success('Sukses!', 'Berhasil simpan data.');
        return redirect()->back();
    }
}

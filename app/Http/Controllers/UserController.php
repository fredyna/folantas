<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'petugasrs']);
    }
    public function index()
    {
        $data['roles'] = Role::all();
        return view('user.index')->with($data);
    }

    public function userJson(Request $request)
    {
        $role = $request->role ? $request->role : 'semua';
        $user = $request->user()->id;
        $query = User::where(function ($query) use ($role) {
            if ($role != 'semua')
                $query->where('role_id', $role);
        })
            ->orderBy('email', 'asc')
            ->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('verifikasi', function ($query) {
                $verifikasi = '<span class="badge badge-dark">belum</span>';
                if ($query->email_verified_at)
                    $verifikasi = '<span class="badge badge-success">sudah</span>';

                return $verifikasi;
            })
            ->editColumn('role', function ($query) {
                return $query->role->name;
            })
            ->addColumn('action', function ($query) use ($user) {
                $url = route('user.destroy', $query->id);
                $input_csrf = csrf_field();
                $input_delete = method_field('delete');

                $edit = '<a href="javascript:void(0)" onclick="editData(\'' . $query->id . '\', \'' . $query->email . '\', \'' . $query->name . '\', \'' . $query->role_id . '\', \'' . $query->phone . '\')" class="p-1" data-toggle="tooltip" data-placement="left" title="Edit">
                    <i class="fa fa-edit text-success font-medium-3"></i>
                </a>';

                $delete = '<a href="javascript:void(0)" onclick="hapusData(\'' . $query->id . '\')" class="p-1" data-toggle="tooltip" data-placement="right" title="Hapus">
                    <i class="fa fa-trash text-danger font-medium-3"></i>
                    </a>
                    <form id="user-' . $query->id . '" action="' . $url . '" method="post" style="display:none;">
                        ' . $input_csrf . ' ' . $input_delete . '
                        <input type="hidden" name="idUser-' . $query->id . '" value="">
                        <input type="submit" value="OK">
                    </form>';

                return $query->id == $user ? '' : $edit . ' ' . $delete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        if ($request->method == 'patch') {
            $this->update($request, $request->id_user);
        } else {
            $request->validate([
                'email'         => 'required|unique:users',
                'name'          => 'required|string',
                'password'      => 'required|min:5|same:r_password',
                'role'          => 'required',
            ], $this->messages());

            $data = [
                'email'     => $request->email,
                'name'      => $request->name,
                'password'  => bcrypt($request->password),
                'role_id'   => $request->role,
            ];

            $user = User::create($data);
            Alert::success('Sukses!', 'Berhasil menyimpan data.');
        }
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|email',
            'name'  => 'required|String',
            'role'  => 'required',
        ], $this->messages());

        $data = [
            'email'     => $request->email,
            'name'      => $request->name,
            'role_id'   => $request->role,
        ];

        if ($request->password != '') {
            $request->validate([
                'password' => 'required|min:5|same:r_password'
            ], $this->messages());
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        Alert::success('Sukses!', 'Berhasil menyimpan data.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('Terhapus!', 'Berhasil hapus data.');

        return redirect()->back();
    }

    public function messages()
    {
        return [
            'unique'    => 'sudah ada :attribute yang sama!',
            'required' => ':attribute harus diisi!',
            'password.same'  => 'password dan konfirmasi password harus sama!',
        ];
    }
}

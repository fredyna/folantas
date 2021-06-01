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
        $role = $request->role;
        $status = $request->status;
        $query = User::where('role_id', '<>', 1)
            ->where('status', $status)
            ->where(function ($query) use ($request) {
                if ($request->user()->role->name == 'petugasrs')
                    $query->where('username', 'like', "%{$request->user()->username}%");
            })
            ->where(function ($query) use ($role) {
                if ($role != '')
                    $query->where('role_id', $role);
            })
            ->orderBy('status', 'desc')
            ->orderBy('username', 'asc')
            ->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status', function ($query) {
                if ($query->status)
                    $status = '<label class="text-success">Aktif</label>';
                else
                    $status = '<label class="text-danger">Nonaktif</label>';

                return $status;
            })
            ->editColumn('role', function ($query) {
                return $query->role->name;
            })
            ->addColumn('action', function ($query) {
                $url = route('user.destroy', $query->id);
                $url_activated = route('user.activated', $query->id);
                $input_csrf = csrf_field();
                $input_delete = method_field('delete');

                $edit = '<a href="javascript:void(0)" onclick="editData(\'' . $query->id . '\', \'' . $query->username . '\', \'' . $query->name . '\', \'' . $query->role_id . '\', \'' . $query->phone . '\')" class="p-1" data-toggle="tooltip" data-placement="left" title="Edit">
                    <i class="fa fa-edit text-success font-medium-3"></i>
                </a>';

                if ($query->status) {
                    $status = '<a href="javascript:void(0)" onclick="activated(\'' . $url_activated . '\')" class="p-1" data-toggle="tooltip" data-placement="left" title="Nonaktifkan">
                        <i class="fa fa-close text-warning font-medium-3"></i>
                    </a>';
                } else {
                    $status = '<a href="javascript:void(0)" onclick="activated(\'' . $url_activated . '\')" class="p-1" data-toggle="tooltip" data-placement="left" title="Aktifkan">
                        <i class="fa fa-check text-success font-medium-3"></i>
                    </a>';
                }

                $delete = '<a href="javascript:void(0)" onclick="hapusData(\'' . $query->id . '\')" class="p-1" data-toggle="tooltip" data-placement="right" title="Hapus">
                    <i class="fa fa-trash text-danger font-medium-3"></i>
                </a>
                <form id="user-' . $query->id . '" action="' . $url . '" method="post" style="display:none;">
                    ' . $input_csrf . ' ' . $input_delete . '
                    <input type="hidden" name="idUser-' . $query->id . '" value="">
                    <input type="submit" value="OK">
                </form>';

                return $edit . ' ' . $status . ' ' . $delete;
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
                'username'      => 'required|unique:users',
                'name'          => 'required|String',
                'password'      => 'required|min:8|same:r_password',
                'role'          => 'required',
                'phone'         => 'nullable|min:10|max:15'
            ], $this->messages());

            $username = $request->username;
            $role = $request->role;

            if ($request->user()->role_id == 2) {
                $username = $request->user()->username . '_' . $request->username;
                $role = 3;
            }

            $data = [
                'username'  => $username,
                'name'      => $request->name,
                'password'  => bcrypt($request->password),
                'role_id'   => $role,
                'phone'     => $request->phone
            ];

            $user = User::create($data);
            $user ?
                Alert::success('Sukses!', 'Berhasil menyimpan data.') : Alert::error('Gagal!', 'Gagal menyimpan data.');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'username'   => 'required',
            'name'  => 'required|String',
            'role'  => 'required',
            'phone' => 'nullable|min:10|max:15'
        ], $this->messages());

        $username = $request->username;
        $role = $request->role;

        if ($user->username != $request->username) {
            $request->validate(['username' => 'unique:users'], $this->messages());

            if ($request->user()->role_id == 2) {
                $username = $request->user()->username . '_' . Str::replaceFirst($request->user()->username . '_', '', $request->username);
            }
        }

        if ($request->user()->role_id == 2) $role = 3;

        $data = [
            'username'  => $username,
            'name'      => $request->name,
            'role_id'   => $role,
            'phone'     => $request->phone
        ];

        if ($request->password != '') {
            $request->validate([
                'password' => 'required|min:8|same:r_password'
            ], $this->messages());
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        $user ?
            Alert::success('Sukses!', 'Berhasil menyimpan data.') : Alert::error('Gagal!', 'Gagal menyimpan data.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            try {
                $user->delete();
                Alert::success('Terhapus!', 'Berhasil hapus data.');
            } catch (\Exception $e) {
                Alert::error('Gagal!', 'Gagal hapus data kemungkinan data user telah digunakan pada data lain.');
            }
        }

        return redirect()->back();
    }

    public function messages()
    {
        return [
            'unique'    => 'sudah ada :attribute yang sama!',
            'required' => ':attribute harus diisi!',
            'password.same'  => 'Isian password dan ulang password harus sama!',
        ];
    }
}

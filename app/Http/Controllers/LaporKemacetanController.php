<?php

namespace App\Http\Controllers;

use App\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class LaporKemacetanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $first_date = $request->first_date ? date('Y-m-d', strtotime($request->first_date)) : date('Y-m-d');
        $last_date = $request->last_date ? date('Y-m-d', strtotime($request->last_date . '+ 1 day')) : date('Y-m-d', strtotime(date('Y-m-d') . '+ 1 day'));
        $user = $request->user();

        $data['first_date'] = $first_date;
        $data['last_date'] = $last_date;
        $data['laporan'] = Laporan::where('kategori', 'KEMACETAN')
            ->where(function ($query) use ($user) {
                if ($user->role_id != 1)
                    $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan.kemacetan.index')->with($data);
    }

    public function create()
    {
        return view('laporan.kemacetan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:5|max:200',
            'foto' => 'required|image',
            'deskripsi' => 'required|max:2000'
        ]);

        $uploadedThumbnail = $request->file('foto');
        $thumbnail = time() . Str::random(22) . '.' . $uploadedThumbnail->getClientOriginalExtension();
        $uploadedThumbnail->move(public_path('berkas/laporan'), $thumbnail);

        $data = [
            'judul' => $request->judul,
            'foto' => $thumbnail,
            'kategori' => 'KEMACETAN',
            'user_id' => $request->user()->id,
            'deskripsi' => $request->deskripsi,
        ];

        Laporan::create($data);
        Alert::success('Sukses!', 'Berhasil simpan data.');

        return redirect()->route('lapor-kemacetan.index');
    }

    public function show($id)
    {
        $data['laporan'] = Laporan::findOrFail($id);
        return view('laporan.kemacetan.show')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|min:5|max:200',
            'foto' => 'nullable|image',
            'deskripsi' => 'required|max:2000'
        ]);

        $laporan = Laporan::findOrFail($id);
        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        $uploadedThumbnail = $request->file('foto');
        if (!empty($uploadedThumbnail)) {
            $thumbnail = time() . Str::random(22) . '.' . $uploadedThumbnail->getClientOriginalExtension();
            $uploadedThumbnail->move(public_path('berkas/laporan'), $thumbnail);

            File::delete(public_path('berkas/berita') . '/' . $laporan->foto);
            $data['foto'] = $thumbnail;
        }

        $laporan->update($data);
        Alert::success('Sukses!', 'Berhasil perbarui data.');

        return redirect()->route('lapor-kemacetan.index');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        Alert::success('Sukses!', 'Berhasil hapus data.');
        return redirect()->back();
    }
}

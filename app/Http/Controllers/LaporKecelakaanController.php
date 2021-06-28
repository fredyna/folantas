<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Laporan;
use App\Notifications\LaporanNotification;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class LaporKecelakaanController extends Controller
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
        $data['laporan'] = Laporan::where('kategori', 'KECELAKAAN')
            ->where(function ($query) use ($user) {
                if ($user->role_id != 1)
                    $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan.kecelakaan.index')->with($data);
    }

    public function create()
    {
        return view('laporan.kecelakaan.create');
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
            'kategori' => 'KECELAKAAN',
            'user_id' => $request->user()->id,
            'deskripsi' => $request->deskripsi,
        ];

        DB::beginTransaction();
        try {
            $laporan = Laporan::create($data);
            $url = route('lapor-kecelakaan.show', $laporan->id);
            $laporan['url'] = $url;

            $user = User::where('role_id', 1)->first();
            Notification::send($user, new LaporanNotification($laporan));

            DB::commit();
            Alert::success('Sukses!', 'Berhasil simpan data.');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error!', 'Gagal simpan data. ' . $e->getMessage());
        }

        return redirect()->route('lapor-kecelakaan.index');
    }

    public function show($id)
    {
        $data['laporan'] = Laporan::findOrFail($id);
        return view('laporan.kecelakaan.show')->with($data);
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

        return redirect()->route('lapor-kecelakaan.index');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        Alert::success('Sukses!', 'Berhasil hapus data.');
        return redirect()->back();
    }

    public function create_berita(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required',
        ]);

        $laporan = Laporan::findOrFail($request->laporan_id);
        File::copy(public_path('berkas/laporan/' . $laporan->foto), public_path('berkas/berita/' . $laporan->foto));

        $data = [
            'judul' => $laporan->judul,
            'thumbnail' => $laporan->foto,
            'deskripsi' => $laporan->deskripsi,
            'slug' => Str::slug($laporan->judul, '-'),
        ];

        Berita::create($data);
        Alert::success('Sukses!', 'Berhasil membuat berita.');

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $data['berita'] = Berita::latest()->get();
        return view('berita.index')->with($data);
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:5|max:200',
            'thumbnail' => 'required|image',
            'deskripsi' => 'required|max:2000'
        ]);

        $uploadedThumbnail = $request->file('thumbnail');
        $thumbnail = time() . Str::random(22) . '.' . $uploadedThumbnail->getClientOriginalExtension();
        $uploadedThumbnail->move(public_path('berkas/berita'), $thumbnail);

        $data = [
            'judul' => $request->judul,
            'thumbnail' => $thumbnail,
            'deskripsi' => $request->deskripsi
        ];

        Berita::create($data);
        Alert::success('Sukses!', 'Berhasil simpan data.');

        return redirect()->route('berita.index');
    }

    public function show($id)
    {
        $data['berita'] = Berita::findOrFail($id);
        return view('berita.show')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|min:5|max:200',
            'thumbnail' => 'required|image',
            'deskripsi' => 'required|max:2000'
        ]);

        $berita = Berita::findOrFail($id);
        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ];

        $uploadedThumbnail = $request->file('thumbnail');
        if (!empty($uploadedThumbnail)) {
            $thumbnail = time() . Str::random(22) . '.' . $uploadedThumbnail->getClientOriginalExtension();
            $uploadedThumbnail->move(public_path('berkas/berita'), $thumbnail);

            File::delete(public_path('berkas/berita') . '/' . $berita->thumbnail);
            $data['thumbnail'] = $thumbnail;
        }

        $berita->update($data);
        Alert::success('Sukses!', 'Berhasil perbarui data.');

        return redirect()->route('berita.index');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        Alert::success('Sukses!', 'Berhasil hapus data.');
        return redirect()->back();
    }
}

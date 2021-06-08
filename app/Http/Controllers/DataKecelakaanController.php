<?php

namespace App\Http\Controllers;

use App\DataKecelakaan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataKecelakaanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $data['kecelakaan'] = DataKecelakaan::latest()->get();
        return view('data-kecelakaan.index')->with($data);
    }

    public function create()
    {
        return view('data-kecelakaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_laka' => 'required',
            'sebab_laka' => 'required',
            'tkp' => 'required',
            'hari' => 'required',
            'waktu_laka' => 'required|date',
            'kendaraan_terlibat' => 'required',
            'jk_korban' => 'required',
            'usia_korban' => 'required|numeric',
            'profesi_korban' => 'required',
            'pendidikan_korban' => 'required',
            'sim_korban' => 'required',
            'jk_pelaku' => 'nullable',
            'usia_pelaku' => 'nullable|numeric',
            'profesi_pelaku' => 'nullable',
            'pendidikan_pelaku' => 'nullable',
            'sim_pelaku' => 'nullable',
        ]);

        $data = $request->all();

        DataKecelakaan::create($data);
        Alert::success('Sukses!', 'Berhasil simpan data');
        return redirect()->route('data-kecelakaan.index');
    }

    public function show($id)
    {
        $data['kecelakaan'] = DataKecelakaan::findOrFail($id);
        return view('data-kecelakaan.show')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_laka' => 'required',
            'sebab_laka' => 'required',
            'tkp' => 'required',
            'hari' => 'required',
            'waktu_laka' => 'required|date',
            'kendaraan_terlibat' => 'required',
            'jk_korban' => 'required',
            'usia_korban' => 'required|numeric',
            'profesi_korban' => 'required',
            'pendidikan_korban' => 'required',
            'sim_korban' => 'required',
            'jk_pelaku' => 'nullable',
            'usia_pelaku' => 'nullable|numeric',
            'profesi_pelaku' => 'nullable',
            'pendidikan_pelaku' => 'nullable',
            'sim_pelaku' => 'nullable',
        ]);

        $data = $request->all();
        $kecelakaan = DataKecelakaan::findOrFail($id);
        $kecelakaan->update($data);

        Alert::success('Sukses!', 'Berhasil perbarui data');
        return redirect()->route('data-kecelakaan.index');
    }

    public function destroy($id)
    {
        $kecelakaan = DataKecelakaan::findOrFail($id);
        $kecelakaan->delete();
        Alert::success('Sukses!', 'Berhasil hapus data');
        return redirect()->back();
    }
}

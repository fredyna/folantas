<?php

namespace App\Http\Controllers;

use App\DataKemacetan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataKemacetanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $first_date = $request->first_date ? date('Y-m-d', strtotime($request->first_date)) : date('Y-m-d');
        $last_date = $request->last_date ? date('Y-m-d', strtotime($request->last_date . '+ 1 day')) : date('Y-m-d', strtotime(date('Y-m-d') . '+ 1 day'));
        $penyebab = $request->penyebab ? $request->penyebab : 'semua';

        $data['first_date'] = $first_date;
        $data['last_date'] = $last_date;
        $data['penyebab'] = $penyebab;

        $data['kemacetan'] = DataKemacetan::select('*')
            ->whereBetween('waktu', [$first_date, $last_date])
            ->where(function ($query) use ($penyebab) {
                if ($penyebab != 'semua')
                    $query->where('penyebab', $penyebab);
            })
            ->get();

        $data['grafik_sebab'] = [
            'KECELAKAAN' => $this->getDataSebabMacet('KECELAKAAN', $first_date, $last_date),
            'PENUTUPAN JALAN' => $this->getDataSebabMacet('PENUTUPAN JALAN', $first_date, $last_date),
            'KERETA API' => $this->getDataSebabMacet('KERETA API', $first_date, $last_date),
            'LAINNYA' => $this->getDataSebabMacet('LAINNYA', $first_date, $last_date),
        ];

        return view('data-kemacetan.index')->with($data);
    }

    public function getDataSebabMacet($penyebab, $first_date, $last_date)
    {
        return DataKemacetan::where('penyebab', $penyebab)
            ->whereBetween('waktu', [$first_date, $last_date])
            ->count();
    }

    public function create()
    {
        return view('data-kemacetan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyebab' => 'required',
            'lokasi' => 'required',
            'panjang' => 'required|numeric',
            'waktu' => 'required|date',
        ]);

        $waktu = date('Y-m-d H:i:s', strtotime($request->waktu . ' ' . $request->jam . ':' . $request->menit . ':' . $request->detik));
        $request->replace($request->except(['jam', 'menit', 'detik']));
        $request->merge(['waktu' => $waktu]);

        $data = $request->all();

        DataKemacetan::create($data);
        Alert::success('Sukses!', 'Berhasil simpan data');
        return redirect()->route('data-kemacetan.index');
    }

    public function show($id)
    {
        $data['kemacetan'] = DataKemacetan::findOrFail($id);
        return view('data-kemacetan.show')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penyebab' => 'required',
            'lokasi' => 'required',
            'panjang' => 'required|numeric',
            'waktu' => 'required|date',
        ]);

        $waktu = date('Y-m-d H:i:s', strtotime($request->waktu . ' ' . $request->jam . ':' . $request->menit . ':' . $request->detik));
        $request->replace($request->except(['jam', 'menit', 'detik']));
        $request->merge(['waktu' => $waktu]);

        $data = $request->all();

        $kemacetan = DataKemacetan::findOrFail($id);
        $kemacetan->update($data);

        Alert::success('Sukses!', 'Berhasil perbarui data');
        return redirect()->route('data-kemacetan.index');
    }

    public function destroy($id)
    {
        $kemacetan = DataKemacetan::findOrFail($id);
        $kemacetan->delete();
        Alert::success('Sukses!', 'Berhasil hapus data');
        return redirect()->back();
    }
}

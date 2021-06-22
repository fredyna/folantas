<?php

namespace App\Http\Controllers;

use App\DataKecelakaan;
use Illuminate\Http\Request;
use PDO;
use RealRashid\SweetAlert\Facades\Alert;

class DataKecelakaanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $first_date = $request->first_date ? date('Y-m-d', strtotime($request->first_date)) : date('Y-m-d');
        $last_date = $request->last_date ? date('Y-m-d', strtotime($request->last_date . '+ 1 day')) : date('Y-m-d', strtotime(date('Y-m-d') . '+ 1 day'));
        $jenis_laka = $request->jenis_laka ? $request->jenis_laka : 'semua';
        $sebab_laka = $request->sebab_laka ? $request->sebab_laka : 'semua';
        $tkp = $request->tkp ? $request->tkp : 'semua';

        $data['first_date'] = $first_date;
        $data['last_date'] = $last_date;
        $data['jenis_laka'] = $jenis_laka;
        $data['sebab_laka'] = $sebab_laka;
        $data['tkp'] = $tkp;
        $data['kecelakaan'] = DataKecelakaan::where(function ($query) use ($jenis_laka) {
            if ($jenis_laka != 'semua')
                $query->where('jenis_laka', $jenis_laka);
        })
            ->whereBetween('waktu_laka', [$first_date, $last_date])
            ->where(function ($query) use ($sebab_laka) {
                if ($sebab_laka != 'semua')
                    $query->where('sebab_laka', $sebab_laka);
            })
            ->where(function ($query) use ($tkp) {
                if ($tkp != 'semua')
                    $query->where('tkp', $tkp);
            })
            ->orderBy('waktu_laka', 'desc')
            ->get();
        $data['grafik_jenis_laka'] = [
            'TABRAK DEPAN' => $this->getDataJenisLaka('TABRAK DEPAN', $first_date, $last_date),
            'TABRAK BELAKANG' => $this->getDataJenisLaka('TABRAK BELAKANG', $first_date, $last_date),
            'TABRAK SAMPING' => $this->getDataJenisLaka('TABRAK SAMPING', $first_date, $last_date),
            'LAKA TUNGGAL' => $this->getDataJenisLaka('LAKA TUNGGAL', $first_date, $last_date),
            'LAKA KRAMBOL' => $this->getDataJenisLaka('LAKA KRAMBOL', $first_date, $last_date),
            'TABRAK LARI' => $this->getDataJenisLaka('TABRAK LARI', $first_date, $last_date),
            'TABRAK MANUSIA' => $this->getDataJenisLaka('TABRAK MANUSIA', $first_date, $last_date),
            'TABRAK KA' => $this->getDataJenisLaka('TABRAK KA', $first_date, $last_date)
        ];
        $data['grafik_sebab_laka'] = [
            'FAKTOR MANUSIA' => $this->getDataSebabLaka('FAKTOR MANUSIA', $first_date, $last_date),
            'FAKTOR KENDARAAN' => $this->getDataSebabLaka('FAKTOR KENDARAAN', $first_date, $last_date),
            'FAKTOR CUACA' => $this->getDataSebabLaka('FAKTOR CUACA', $first_date, $last_date),
            'FAKTOR JALAN' => $this->getDataSebabLaka('FAKTOR JALAN', $first_date, $last_date),
            'LAIN-LAIN' => $this->getDataSebabLaka('LAIN-LAIN', $first_date, $last_date),
        ];
        $data['grafik_tkp'] = [
            'JALAN UTAMA' => $this->getDataTKP('JALAN UTAMA', $first_date, $last_date),
            'JALAN KOTA' => $this->getDataTKP('JALAN KOTA', $first_date, $last_date),
            'JALAN ALTERNATIF' => $this->getDataTKP('JALAN ALTERNATIF', $first_date, $last_date),
            'JALAN TOL' => $this->getDataTKP('JALAN TOL', $first_date, $last_date),
        ];
        return view('data-kecelakaan.index')->with($data);
    }

    public function getDataSebabLaka($sebab_laka, $first_date, $last_date)
    {
        return DataKecelakaan::where('sebab_laka', $sebab_laka)
            ->whereBetween('waktu_laka', [$first_date, $last_date])
            ->count();
    }

    public function getDataJenisLaka($jenis_laka, $first_date, $last_date)
    {
        return DataKecelakaan::where('jenis_laka', $jenis_laka)
            ->whereBetween('waktu_laka', [$first_date, $last_date])
            ->count();
    }

    public function getDataTKP($tkp, $first_date, $last_date)
    {
        return DataKecelakaan::where('tkp', $tkp)
            ->whereBetween('waktu_laka', [$first_date, $last_date])
            ->count();
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

        $waktu_laka = date('Y-m-d H:i:s', strtotime($request->waktu_laka . ' ' . $request->jam . ':' . $request->menit . ':' . $request->detik));
        $request->replace($request->except(['jam', 'menit', 'detik']));
        $request->merge(['waktu_laka' => $waktu_laka]);

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

        $waktu_laka = date('Y-m-d H:i:s', strtotime($request->waktu_laka . ' ' . $request->jam . ':' . $request->menit . ':' . $request->detik));
        $request->replace($request->except(['jam', 'menit', 'detik']));
        $request->merge(['waktu_laka' => $waktu_laka]);

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

<?php

namespace App\Http\Controllers\front;

use App\DataKecelakaan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataKecelakaanController extends Controller
{
    public function index(Request $request)
    {
        $first_date = $request->first_date ? date('Y-m-d', strtotime($request->first_date)) : date('Y-m-d');
        $last_date = $request->last_date ? date('Y-m-d', strtotime($request->last_date . '+ 1 day')) : date('Y-m-d', strtotime(date('Y-m-d') . '+ 1 day'));
        $tipe_grafik = $request->tipe_grafik ? $request->tipe_grafik : 'JENIS LAKA';

        $data['first_date'] = $first_date;
        $data['last_date'] = $last_date;
        $data['tipe_grafik'] = $tipe_grafik;

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
        return view('kecelakaan')->with($data);
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
}

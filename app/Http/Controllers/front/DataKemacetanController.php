<?php

namespace App\Http\Controllers\front;

use App\DataKemacetan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataKemacetanController extends Controller
{
    public function index(Request $request)
    {
        $first_date = $request->first_date ? date('Y-m-d', strtotime($request->first_date)) : date('Y-m-d');
        $last_date = $request->last_date ? date('Y-m-d', strtotime($request->last_date . '+ 1 day')) : date('Y-m-d', strtotime(date('Y-m-d') . '+ 1 day'));
        $penyebab = $request->penyebab ? $request->penyebab : 'semua';

        $data['first_date'] = $first_date;
        $data['last_date'] = $last_date;
        $data['penyebab'] = $penyebab;

        $data['grafik_sebab'] = [
            'KECELAKAAN' => $this->getDataSebabMacet('KECELAKAAN', $first_date, $last_date),
            'PENUTUPAN JALAN' => $this->getDataSebabMacet('PENUTUPAN JALAN', $first_date, $last_date),
            'KERETA API' => $this->getDataSebabMacet('KERETA API', $first_date, $last_date),
            'LAINNYA' => $this->getDataSebabMacet('LAINNYA', $first_date, $last_date),
        ];

        return view('kemacetan')->with($data);
    }

    public function getDataSebabMacet($penyebab, $first_date, $last_date)
    {
        return DataKemacetan::where('penyebab', $penyebab)
            ->whereBetween('waktu', [$first_date, $last_date])
            ->count();
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Berita;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends BaseController
{
    public function index()
    {
        $berita = Berita::select(
            'berita.*',
            'users.name',
            'rumah_sakit.nama as nama_rs',
            'laporan.kategori',
            'laporan.deskripsi',
            'laporan.lokasi',
            'laporan.created_at as waktu_kejadian'
        )
            ->join('laporan', 'laporan.id', '=', 'berita.laporan_id')
            ->join('users', 'users.id', '=', 'laporan.user_id')
            ->join('rumah_sakit', 'rumah_sakit.id', '=', 'laporan.rumah_sakit_id')
            ->leftJoin('ambulans', 'ambulans.id', '=', 'laporan.ambulan_id')
            ->get();

        return $berita ?
            $this->sendResponse($berita, 'Data berita ditemukan.') : $this->sendError('Data berita tidak ditemukan.');
    }
}

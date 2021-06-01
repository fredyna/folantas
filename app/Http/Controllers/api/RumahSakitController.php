<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RumahSakitController extends Controller
{
    public function show($id)
    {
        $rumahsakit = RumahSakit::find($id);
        if ($rumahsakit) {
            $data = [
                'success' => true,
                'message' => 'Data rumah sakit ditemukan.',
                'data'  => $rumahsakit,
            ];

            $data['data']['fasilitas_ambulans'] = $rumahsakit->ambulans()->count();
            $data['data']['fasilitas_sopir'] = $rumahsakit->sopirAmbulans()->count();
        } else {
            $data = [
                'success' => false,
                'message'  => 'Data rumah sakit gagal ditemukan.',
                'data' => null
            ];
        }

        return response()->json($data);
    }
}

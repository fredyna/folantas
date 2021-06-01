<?php

namespace App\Http\Controllers\api;

use App\Ambulans;
use App\Http\Controllers\Controller;
use App\RumahSakit;
use GoogleMaps\Facade\GoogleMapsFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NearHospitalController extends Controller
{
    public function index(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required'
        ], $this->messages());

        if ($validasi->fails()) {
            $data = [
                'success' => false,
                'message' => $validasi->errors()->first(),
            ];

            return response()->json($data, 400);
        }

        if (!empty($request->kategori) && $request->kategori != 'melahirkan') {
            $rumahsakit = RumahSakit::where('rumah_sakit.kategori', 'umum')
                ->get();
        } else {
            $rumahsakit = RumahSakit::all();
        }

        $latlng_origin = $request->latitude . ',' . $request->longitude;
        $latlng_destination = '';

        for ($i = 0; $i < $rumahsakit->count(); $i++) {
            $latlng_destination = $latlng_destination == '' ?  $rumahsakit[$i]->latitude . ',' . $rumahsakit[$i]->longitude : $latlng_destination . '|' . $rumahsakit[$i]->latitude . ',' . $rumahsakit[$i]->longitude;
        }

        $distances = $this->getDistance($latlng_origin, $latlng_destination);
        for ($i = 0; $i < count($distances->rows[0]->elements); $i++) {
            $rumahsakit[$i]['jarak'] = $distances->rows[0]->elements[$i]->distance->value;
            $rumahsakit[$i]['fasilitas_ambulans'] = $rumahsakit[$i]->ambulans()->count();
            $rumahsakit[$i]['fasilitas_sopir'] = $rumahsakit[$i]->sopirAmbulans()->count();
        }

        $rs_collect = collect($rumahsakit);
        $rumahsakit = $rs_collect->sortBy('jarak')->values()->toArray();

        $http_status = 200;
        if ($rumahsakit) {
            $data = [
                'success' => true,
                'message' => 'Pencarian rumah sakit terdekat berhasil.',
                'data'  => $rumahsakit,
            ];
        } else {
            $data = [
                'success' => false,
                'message'  => 'Pencarian rumah sakit terdekat gagal.',
                'data' => null
            ];
            $http_status = 204;
        }

        return response()->json($data, $http_status);
    }

    public function messages()
    {
        return [
            'latitude.required' => 'Latitude tidak boleh kosong!',
            'longitude.required'  => 'Longitude tidak boleh kosong!',
        ];
    }

    public function getDistance($latlng_origin, $latlng_destination)
    {
        $distance = GoogleMapsFacade::load('distancematrix')
            ->setParamByKey('origins', $latlng_origin)
            ->setParamByKey('destinations', $latlng_destination)
            ->setEndpoint('json')
            ->get();

        $data = json_decode($distance);
        return $data;
    }
}

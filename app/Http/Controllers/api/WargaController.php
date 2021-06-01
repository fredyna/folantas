<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController as BaseController;
use App\Notifications\WargaRegisterNotif;
use App\User;
use App\Warga;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WargaController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nik' => 'required|max:16|min:16'
        ], $this->messages());

        if ($validasi->fails()) {
            return $this->sendError('Validasi Error!', $validasi->errors());
        }

        $base_url = 'http://103.12.164.52:8185/ws_server/get_json/rsiharapananda/nik';
        $username = env('DISDUK_USERNAME', 'username');
        $password = env('DISDUK_PASSWORD', 'password');
        $url = $base_url . '?USER_ID=' . $username . '&PASSWORD=' . $password . '&NIK=' . $request->nik;

        $client = new Client();
        $response = $client->get($url);
        $data = '';
        if ($response->getStatusCode() == 200) {
            $result = $response->getBody();
            $result = json_decode($result);
            $message = 'Data warga berhasil ditemukan.';
            $data = $result->content;

            if ($result->totalElements == 0) {
                $message = 'Data warga tidak ditemukan.';
                $data = null;
            }

            return $this->sendResponse($data, $message);
        }

        return $this->sendError('Pencarian data warga gagal diproses.', ['error' => 'Pencarian gagal.']);
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'ktp' => 'required|image',
            // 'bersama_ktp' => 'required|image',
        ], $this->messages());

        if ($validasi->fails()) {
            return $this->sendError('Validasi Error!', $validasi->errors());
        }

        $cek_warga = Warga::find($request->user()->username);
        if ($cek_warga)
            return $this->sendError('Data warga sudah terdaftar.', ['error' => 'Data warga sudah terdaftar dalam sistem']);

        $warga = $this->getDataWarga($request->user()->username);
        if ($warga == null)
            return $this->sendError('Data warga tidak ditemukan.', ['error' => 'Data warga tidak ditemukan di server kami.']);

        $ktp = '';
        $uploadedKTP = $request->file('ktp');
        if (!empty($uploadedKTP)) {
            $ktp = time() . Str::random(22) . '.' . $uploadedKTP->getClientOriginalExtension();
            $uploadedKTP->move(public_path('berkas/warga/ktp'), $ktp);
        }

        // $bersama_ktp = '';
        // $uploadedBersamaKTP = $request->file('bersama_ktp');
        // if (!empty($uploadedBersamaKTP)) {
        //     $bersama_ktp = time() . Str::random(22) . '.' . $uploadedBersamaKTP->getClientOriginalExtension();
        //     $uploadedBersamaKTP->move(public_path('berkas/warga/bersama-ktp'), $bersama_ktp);
        // }

        $user = User::where('username', $request->user()->username)->first();

        $data = [
            'nik' => $request->user()->username,
            'user_id' => $user->id,
            'nama' => $warga[0]->NAMA_LGKP,
            'tempat_lahir' => $warga[0]->TMPT_LHR,
            'tanggal_lahir' => date('Y-m-d', strtotime($warga[0]->TGL_LHR)),
            'jenis_kelamin' => $warga[0]->JENIS_KLMIN,
            'kelurahan' => $warga[0]->KEL_NAME,
            'kecamatan' => $warga[0]->KEC_NAME,
            'alamat' => $warga[0]->ALAMAT,
            'ktp' => $ktp,
            // 'bersama_ktp' => $bersama_ktp,
        ];

        $result = Warga::create($data);
        if ($result) {
            $admin = User::where('role_id', '1')->get();
            Notification::send($admin, new WargaRegisterNotif($result));

            return $this->sendResponse($result, 'Data warga berhasil disimpan.');
        }

        return $this->sendError('Data warga gagal disimpan.', ['error' => 'Data gagal disimpan.']);
    }

    public function getDataWarga($nik)
    {
        $base_url = 'http://103.12.164.52:8185/ws_server/get_json/rsiharapananda/nik';
        $username = env('DISDUK_USERNAME', 'username');
        $password = env('DISDUK_PASSWORD', 'password');
        $url = $base_url . '?USER_ID=' . $username . '&PASSWORD=' . $password . '&NIK=' . $nik;

        $client = new Client();
        $response = $client->get($url);
        $data = '';
        if ($response->getStatusCode() != 200)
            $data == null;
        else {
            $result = $response->getBody();
            $result = json_decode($result);
            $data = $result->content;
        }

        return $data;
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.min'  => 'Format NIK salah!',
            'nik.max'  => 'Format NIK salah',
            'ktp.required' => 'KTP tidak boleh kosong!',
            'ktp.image' => 'KTP harus berbentuk file gambar',
            'bersama_ktp.required' => 'KTP tidak boleh kosong!',
            'bersama_ktp.image' => 'KTP harus berbentuk file gambar',
        ];
    }

    public function show(Request $request)
    {
        $warga = $request->user()->warga;
        if ($warga) {
            $data = [
                'success' => true,
                'message' => 'Data warga ditemukan.',
                'data'  => $warga,
            ];
        } else {
            $data = [
                'success' => false,
                'message'  => 'Data warga gagal ditemukan.',
                'data' => null
            ];
        }

        return response()->json($data);
    }
}

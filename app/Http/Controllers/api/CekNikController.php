<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class CekNikController extends Controller
{
    public function index(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nik' => 'required|max:16|min:16'
        ], $this->messages());

        if ($validasi->fails()) {
            $data = [
                'success' => false,
                'message' => $validasi->errors()->first(),
            ];

            return response()->json($data, 400);
        }

        $base_url = 'http://103.12.164.52:8185/ws_server/get_json/rsiharapananda/nik';
        $username = env('DISDUK_USERNAME', 'username');
        $password = env('DISDUK_PASSWORD', 'password');
        $url = $base_url . '?USER_ID=' . $username . '&PASSWORD=' . $password . '&NIK=' . $request->nik;

        $client = new Client();
        $response = $client->get($url);
        $data = '';
        $http_status = 200;
        if ($response->getStatusCode() == 200) {
            $result = $response->getBody();
            $result = json_decode($result);
            $message = 'Pencarian NIK berhasil diproses.';
            $data = $result->content;

            if ($result->totalElements == 0) {
                $message = 'NIK tidak ditemukan.';
                $data = null;
            }
            $data = [
                'success' => true,
                'message' => $message,
                'data' => $data,
            ];
        } else {
            $http_status = 400;
            $data = [
                'success' => false,
                'message' => 'Pencarian NIK gagal diproses.',
                'data' => null,
            ];
        }

        return response()->json($data, $http_status);
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.min'  => 'Format NIK salah!',
            'nik.max'  => 'Format NIK salah',
        ];
    }
}

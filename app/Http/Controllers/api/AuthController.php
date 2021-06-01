<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController as BaseController;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'       => 'required|unique:users',
            'phone'     => 'required|unique:users',
            'password'  => 'required|min:8',
        ], $this->messages());

        if ($validator->fails())
            return $this->sendError('Validasi Error!', $validator->errors());

        if ($this->checkNIK($request->nik))
            return $this->sendError('NIK sudah pernah terdaftar.');

        $nama_warga = $this->getDataWarga($request->username);

        if ($nama_warga == null)
            return $this->sendError('NIK tidak terdaftar di kota Tegal.');

        $input = $request->all();
        $token = Str::random(80);
        $input['role_id']  = 4;
        $input['password'] = bcrypt($input['password']);
        $input['api_token'] = hash('sha256', $token);
        $input['status']    = false;
        $input['name'] = $nama_warga;

        $user = User::create($input);

        $result = [
            'username' => $user->nik,
            'phone'    => $user->phone,
            'name'     => $user->name,
            'token'    => $token,
        ];

        if ($user)
            return $this->sendResponse($result, 'Registrasi user berhasil.');
        else
            return $this->sendError('Registrasi user gagal.', ['error' => 'Registrasi user gagal.']);
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
        if ($response->getStatusCode() == 200) {
            $result = $response->getBody();
            $result = json_decode($result);

            if ($result->totalElements != 0) {
                return $result->content[0]->NAMA_LGKP;
            }
        }


        return null;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
            'device_token' => 'required'
        ], $this->messages());

        if ($validator->fails()) {
            return $this->sendResponse('Validasi Error!', $validator->errors());
        }

        if (User::where('username', $request->username)->count() <= 0)
            return $this->sendError('Username belum terdaftar.');

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = User::find(Auth::user()->id);

            $token = Str::random(80);

            $user->device_token = $request->device_token;
            $user->api_token = hash('sha256', $token);
            $user->save();

            $result = [
                'username' => $user->username,
                'role'     => $user->role->name,
                'phone'    => $user->phone,
                'name'     => $user->name,
                'status'   => $user->status == 1 ? true : false,
                'api_token'    => $token,
                'data_warga'   => $user->warga ? true : false,
            ];

            return $this->sendResponse($result, 'Login berhasil.');
        } else {
            return $this->sendError('Gagal login.', ['error' => 'Gagal login']);
        }
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.unique'   => 'NIK sudah terdaftar.',
            'phone.required'    => 'No HP tidak boleh kosong.',
            'phone.unique'      => 'No HP sudah terdaftar.',
            'name.required'     => 'Nama tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min'      => 'Password tidak boleh kurang dari :min karakter',
            'r_password.required' => 'Password ulang tidak boleh kosong.',
            'r_password.same'   => 'Password ulang tidak sama dengan password.',
        ];
    }

    public function checkPhone($phone)
    {
        $user = User::where('phone', $phone)->first();
        if ($user) {
            $data = [
                'success' => true,
                'message' => 'No HP telah terdaftar.',
                'data'  => $user,
            ];
        } else {
            $data = [
                'success' => false,
                'message'  => 'No HP belum terdaftar',
                'data' => null
            ];
        }

        return response()->json($data);
    }

    public function checkToken($token)
    {
        $hash_token = hash('sha256', $token);
        $user = User::where('api_token', $hash_token)->first();
        if ($user) {
            $data = [
                'success' => true,
                'message' => 'Data user ditemukan.',
                'data'  => $user,
            ];
        } else {
            $data = [
                'success' => false,
                'message'  => 'Data user gagal ditemukan.',
                'data' => null
            ];
        }

        return response()->json($data);
    }

    public function checkNIK($nik)
    {
        $user = User::where('username', $nik)->first();
        if ($user) {
            return true;
        }

        return false;
    }

    public function getByNIK($nik)
    {
        if (!$nik) {
            $data = [
                'success' => true,
                'message' => 'NIK tidak boleh kosong!',
                'data'  => null,
            ];
            return response()->json($data);
        }


        $user = User::where('username', $nik)->first();
        if ($user) {
            $data = [
                'success' => true,
                'message' => 'Data user ditemukan.',
                'data'  => $user,
            ];
        } else {
            $data = [
                'success' => false,
                'message'  => 'Data user gagal ditemukan.',
                'data' => null
            ];
        }

        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Ambulans;
use App\Berita;
use App\Http\Controllers\Controller;
use App\Laporan;
use App\Notifications\LaporanKejadianNotification;
use App\RumahSakit;
use App\SopirAmbulans;
use App\StatusLaporan;
use App\User;
use Carbon\Carbon;
use GoogleMaps\Facade\GoogleMapsFacade;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Kreait\Firebase\Messaging\Notification as NotifFB;
use Kreait\Firebase\Messaging\CloudMessage;

class ApiLaporanController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $role = $request->user()->role->name;
        $result = Laporan::select('laporan.*', 'users.name as user', 'users.username as nik')
            ->join('users', 'users.id', '=', 'laporan.user_id')
            ->where(function ($query) use ($role, $request) {
                if ($role == 'warga')
                    $query->where('user_id', $request->user()->id);
                else if ($role == 'sopir') {
                    $query->where('sopir_ambulan_id', $request->user()->sopir->id);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return $result ?
            $this->sendResponse($result, 'Data laporan ditemukan.') : $this->sendError('Data laporan tidak ditemukan.');
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            // 'user' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'kategori' => 'required',
            'foto_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'deskripsi' => 'required'
        ], $this->messages());

        if ($validasi->fails()) {
            $data = [
                'success' => false,
                'message' => $validasi->errors()->first(),
            ];

            return response()->json($data, 400);
        }

        /** cari rumah sakit terdekat */

        if ($request->kategori != 'melahirkan') {
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
            $rumahsakit[$i]['estimasi'] = $distances->rows[0]->elements[$i]->duration->text;
        }

        $rs_collect = collect($rumahsakit);
        $rs_terdekat = $rs_collect->sortBy('jarak')->values()->toArray();

        $data = [
            'user_id' => $request->user()->id,
            'rumah_sakit_id' => $rs_terdekat[0]['id'],
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'lokasi' => $distances->origin_addresses[0],
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'estimasi_waktu' => $rs_terdekat[0]['estimasi'],
            'status' => 'terkirim',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $foto_1 = '';
        $foto_2 = '';
        $foto_3 = '';

        // resizing an uploaded file
        if (!empty($request->file('foto_1'))) $foto_1 = $this->imageUpload($request->file('foto_1'));
        if (!empty($request->file('foto_2'))) $foto_2 = $this->imageUpload($request->file('foto_2'));
        if (!empty($request->file('foto_3'))) $foto_3 = $this->imageUpload($request->file('foto_3'));
        if (!$foto_1) {
            $data = [
                'success' => false,
                'message' => "Gagal upload foto",
            ];

            return response()->json($data, 400);
        } else $data['foto_1'] = $foto_1;

        if ($foto_2) $data['foto_2'] = $foto_2;
        if ($foto_3) $data['foto_3'] = $foto_3;

        DB::beginTransaction();

        try {
            $id_laporan = DB::table('laporan')->insertGetId($data);

            $data_status_laporan = [
                'laporan_id' => $id_laporan,
                'rumah_sakit_id' => $rs_terdekat[0]['id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $id_status = DB::table('status_laporan')->insertGetId($data_status_laporan);

            DB::commit();

            /** create notification */
            $user = User::find($rs_terdekat[0]['user_id']);
            $data_notif = StatusLaporan::find($id_status);
            $user->notify(new LaporanKejadianNotification($data_notif));
            /** end create notification */

            $data = [
                'success' => true,
                'message' => "Berhasil mengirimkan laporan.",
                'data'    => $data
            ];

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $data = [
                'success' => false,
                'message' => "Gagal mengirimkan laporan.",
            ];

            return response()->json($data, 204);
        }
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

    public function imageUpload($uploadedFoto)
    {
        $foto = time() . Str::random(22) . '.' . $uploadedFoto->getClientOriginalExtension();
        $destinationPath = public_path('berkas/laporan');
        $img = Image::make($uploadedFoto->path());
        $img->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $foto);

        return $foto;
    }

    public function messages()
    {
        return [
            'user.required' => 'User tidak boleh kosong',
            'latitude.required' => 'Latitude lokasi tidak terkirim',
            'longitude.required' => 'Longitude lokasi tidak terkirim',
            'kategori.required' => 'Kategori tidak boleh kosong',
            'foto_1.required' => 'Foto tidak boleh kosong',
            'foto_1.image' => 'Tipe file foto harus gambar',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
        ];
    }

    public function status($id)
    {
        $status = StatusLaporan::select(
            'status_laporan.id',
            'status_laporan.status',
            'rumah_sakit.nama as nama_rs',
            'ambulans.no_polisi',
            'sopir_ambulans.nama',
            'status_laporan.created_at'
        )
            ->join('rumah_sakit', 'rumah_sakit.id', '=', 'status_laporan.rumah_sakit_id')
            ->leftJoin('ambulans', 'ambulans.id', '=', 'status_laporan.ambulan_id')
            ->leftJoin('sopir_ambulans', 'sopir_ambulans.id', '=', 'status_laporan.sopir_ambulan_id')
            ->where('laporan_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        return $status ?
            $this->sendResponse($status, 'Data laporan ditemukan.') : $this->sendError('Data laporan tidak ditemukan.');
    }

    public function changeStatus($id)
    {
        $laporan = Laporan::find($id);
        $status = 'selesai';
        if ($laporan->status == 'diterima') $status = 'menuju lokasi';
        if ($laporan->status == 'menuju lokasi') $status = 'menuju rumah sakit';
        if ($laporan->status == 'menuju rumah sakit') $status = 'selesai';

        $data_status_laporan = [
            'laporan_id' => $id,
            'rumah_sakit_id' => $laporan->rumah_sakit_id,
            'ambulan_id'    => $laporan->ambulan_id,
            'sopir_ambulan_id' => $laporan->sopir_ambulan_id,
            'status'    => $status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::beginTransaction();
        try {
            $laporan->update(['status' => $status]);
            StatusLaporan::create($data_status_laporan);

            //ubah status ambulans dan sopir
            $ambulans = Ambulans::find($laporan->ambulan_id);
            $sopir = SopirAmbulans::find($laporan->sopir_ambulan_id);
            if ($status == 'selesai') {
                $ambulans->update(['status' => true]);
                $sopir->update(['status' => true]);
            }

            if ($status == 'selesai' && ($laporan->kategori == 'kecelakaan' || $laporan->kategori == 'bencana')) {
                $data_berita = ['laporan_id' => $laporan->id];
                Berita::create($data_berita);
            }

            DB::commit();

            if ($status == 'menuju lokasi') {
                //send push notification
                $title = 'Menuju Lokasi';
                $body = 'Ambulans dari ' . $laporan->rumahsakit->nama . ' menuju lokasi dengan estimasi waktu ' . $laporan->estimasi_waktu . '.';
                $data = [
                    'id_laporan' => $laporan->id,
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ];
            } else if ($status == 'menuju rumah sakit') {
                //send push notification
                $title = 'Menuju Rumah Sakit';
                $body = 'Ambulans dari ' . $laporan->rumahsakit->nama . ' menuju rumah sakit.';
                $data = [
                    'id_laporan' => $laporan->id,
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ];
            } else if ($status == 'selesai') {
                //send push notification
                $title = 'Laporan Selesai';
                $body = 'Ambulans telah sampai di ' . $laporan->rumahsakit->nama . '';
                $data = [
                    'id_laporan' => $laporan->id,
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ];
            }
            $this->sendNotifFB($laporan->user->device_token, $title, $body, $data);


            return $this->sendResponse($laporan, 'Berhasil mengubah status');
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendError('Gagal mengubah status');
        }
    }

    public function sendNotifFB($device_token, $title, $body, $data)
    {
        $messaging = app('firebase.messaging');

        $deviceToken = $device_token;
        $icon = 'https://sidarat.ta2020.xyz/assets/images/icon/favicon-32x32.png';

        $notification = NotifFB::fromArray([
            'title' => $title,
            'body' => $body,
            'icon' => $icon,
        ]);

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification) // optional
            ->withData($data); // optional

        $messaging->send($message);

        return true;
    }
}

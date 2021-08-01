<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NotificationController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $data['notifications'] = $request->user()->notifications()->paginate(10);
        return view('notification.index')->with($data);
    }

    public function index_json(Request $request)
    {
        $notifications = $request->user()->unreadNotifications()->paginate(10);

        $http_response = 200;
        if ($notifications) {
            $data = [
                'success' => true,
                'message' => 'Berhasil memuat notifikasi',
                'data'  => $notifications,
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'Gagal memuat notifikasi',
                'data'  => null,
            ];
            $http_response = 404;
        }

        return response()->json($data, $http_response);
    }

    public function redirect(Request $request)
    {
        $notif = $request->user()->notifications->find($request->id);
        if (!$notif->read_at)
            $notif->markAsRead();
        return redirect($request->url);
    }

    public function read_all(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        Alert::success('Sukses!', 'Berhasil perbarui data.');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $notif = $request->user()->notifications->find($request->id);
        $notif->delete();

        Alert::success('Sukses!', 'Berhasil hapus data.');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Laporan;
use App\StatusLaporan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data['berita'] = Berita::latest()->take(3)->get();
        return view('home')->with($data);
    }
}

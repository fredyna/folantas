<?php

namespace App\Http\Controllers\front;

use App\Berita;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $data['berita'] = Berita::latest()->paginate(6);
        return view('berita')->with($data);
    }

    public function show($slug)
    {
        $data['berita'] = Berita::where('slug', $slug)->first();
        return view('detail-berita')->with($data);
    }
}

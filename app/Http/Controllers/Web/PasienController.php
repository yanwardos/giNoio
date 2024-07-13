<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    # TODO: patient dashboard
    public function index()
    {
        return view('pasien.dashboard');
    }

    # TODO: my teraphy history
    public function teraphyHistory()
    {
        return view('pasien.riwayatList');
    }

    # TODO: halaman terapi pasien
    public function teraphy(){
        return view('pasien.terapi');
    }
}

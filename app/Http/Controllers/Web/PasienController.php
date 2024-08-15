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
    public function teraphyHistory(Request $request)
    {
        $user = $request->user();
        $pasien = $user->getPasien();
        return view('pasien.riwayatList', compact('pasien'));
    }

    # TODO: halaman terapi pasien
    public function teraphy(){
        return view('pasien.terapi');
    }
}

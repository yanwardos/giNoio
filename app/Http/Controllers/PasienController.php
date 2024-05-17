<?php

namespace App\Http\Controllers;

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
}

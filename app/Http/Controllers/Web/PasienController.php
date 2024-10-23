<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    # TODO: patient dashboard
    public function index(Request $request)
    {
        $user = $request->user();
        $pasien = $user->getPasien();
        $monitoringRecords = $pasien->getMonitoringRecords();
        return view('pasien.dashboard', compact('pasien', 'monitoringRecords'));
    }

    # TODO: my teraphy history
    public function teraphyHistory(Request $request)
    {
        $user = $request->user();
        $pasien = $user->getPasien();
        $monitoringRecords = $pasien->getMonitoringRecords();
        return view('pasien.riwayatList', compact('pasien', 'monitoringRecords'));
    }

    # TODO: halaman terapi pasien
    public function teraphy(){
        return view('pasien.terapi');
    }
}

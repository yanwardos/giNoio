<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MedisController extends Controller
{
    # TODO: medis dashboard
    public function index()
    {
        return view('medis.dashboard');
    }

    # TODO: pasien list
    public function pasienList()
    {
        return view('medis.pasienList');
    }

    # TODO: patient's teraphy history
    public function patientTeraphyHistory(User $user)
    {
        return 'medis: patientTeraphyHistory';
    }

    # TODO: patient create
    public function createPasien()
    {
        return 'medis: createPasien';
    }

    # TODO: patient store
    public function storePasien()
    {
        return 'medis: storePasien';
    }

    # TODO: record index
    public function riwayatList()
    {
        return view('medis.riwayatList');
    }
}

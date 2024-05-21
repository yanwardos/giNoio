<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
    }

    public function dashboard()
    {
        return redirect(auth()->user()->role);
    }
}

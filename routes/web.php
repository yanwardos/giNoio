<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\MedisController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/welcome', function () {
    return view('welcome');
});

# TODO: Welcome
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/changepassword', [ChangePasswordController::class, 'index'])->name('changePassword');

Route::middleware('auth')->get('dashboard', function () {
    return redirect(auth()->user()->roles->name);
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Pasien
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/', [PasienController::class], 'index')->name('pasien.dashboard');
    Route::get('/grafik', [PasienController::class], 'teraphyHistory')->name('pasien.teraphyHistory');
});

// medis
Route::middleware(['auth', 'role:medis'])->prefix('medis')->group(function () {
    Route::get('/', [MedisController::class, 'index'])->name('medis.dashboard');
    Route::get('/pasiens', [MedisController::class, 'pasienList'])->name('medis.pasienList');
    Route::get('/pasien/create', [MedisController::class, 'createPasien'])->name('medis.pasienCreate');
    Route::post('/pasien/store', [MedisController::class, 'storePasien'])->name('medis.pasienStore');

    Route::get('/records', [MedisController::class, 'riwayatList'])->name('medis.riwayatList');
});

Route::get('adminlte', function () {
    return view('layouts.adminlte-sidebar');
});

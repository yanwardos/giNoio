<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FisioterapisController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Pasien
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/dashboard', [PasienController::class], 'index')->name('pasien.dashboard');
    Route::get('/grafik', [PasienController::class], 'teraphyHistory')->name('pasien.teraphyHistory');
});

// Fisioterapis
Route::middleware(['auth', 'role:fisioterapis'])->group(function () {
    Route::get('/dashboard', [FisioterapisController::class, 'index'])->name('fisioterapis.dashboard');
    Route::get('/pasien/list', [FisioterapisController::class, 'pasienList'])->name('fisioterapis.pasienList');
    Route::get('/pasien/create', [FisioterapisController::class, 'createPasien'])->name('fisioterapis.pasienCreate');
    Route::post('/pasien/store', [FisioterapisController::class, 'storePasien'])->name('fisioterapis.pasienStore');
});

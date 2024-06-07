<?php

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\MedisController;
use App\Http\Controllers\Web\ChangePasswordController;
use App\Http\Controllers\Web\GeneralUserController;
use App\Http\Controllers\Web\PasienController;
use App\Models\Admin;
use App\Models\Device;
use App\Models\Medis;
use App\Models\Pasien;
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
// Route::get('/changepassword', [ChangePasswordController::class, 'index'])->name('changePassword');


// General
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function(){
        return redirect(auth()->user()->role->name);
    })->name('dashboard');

    Route::get('myProfile', [GeneralUserController::class, 'showMyProfile'])->name('myProfile');

    Route::get('myProfile/edit', [GeneralUserController::class, 'editMyProfile'])->name('myProfile.edit');
    Route::post('myProfile/update', [GeneralUserController::class, 'updateMyProfile'])->name('myProfile.update');

    Route::get('myPassword/edit', [GeneralUserController::class, 'editMyPassword'])->name('myPassword.edit');
    Route::get('myPassword/update', [GeneralUserController::class, 'updateMyPassword'])->name('myPassword.update');

});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Pasien
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/', [PasienController::class, 'index'])->name('pasien.dashboard');
    Route::get('/grafik', [PasienController::class, 'teraphyHistory'])->name('pasien.teraphyHistory');
});

// medis
Route::middleware(['auth', 'role:medis'])->prefix('medis')->group(function () {
    Route::get('/', [MedisController::class, 'index'])->name('medis.dashboard');

    
    Route::get('/pasien/new', [MedisController::class, 'newPasien'])->name('medis.pasienNew');
    Route::post('/pasien/create', [MedisController::class, 'createPasien'])->name('medis.pasienCreate');

    Route::get('/pasiens', [MedisController::class, 'pasienList'])->name('medis.pasienList');
    Route::get('/pasien/{pasien}', [MedisController::class, 'showPasien'])->name('medis.pasienShow');

    Route::get('/pasien/{pasien}/edit', [MedisController::class, 'editPasien'])->name('medis.pasienEdit');
    Route::post('/pasien/{pasien}/update', [MedisController::class, 'updatePasien'])->name('medis.pasienUpdate');

    Route::post('/pasien/{pasien}/delete', [MedisController::class, 'deletePasien'])->name('medis.pasienDelete');

    Route::post('/pasien/{pasien}/passwordReset', [MedisController::class, 'resetPassword'])->name('medis.pasienPasswordReset');

    Route::get('/riwayatTerapi', [MedisController::class, 'riwayatList'])->name('medis.riwayatList');
    Route::get('/riwayat/pasien/{pasien}', [MedisController::class, 'riwayatPasienList'])->name('medis.riwayatPasienList');
});


// DEVELOPMENT HELPERS
Route::get('adminlte', function () {
    return view('layouts.adminlte-sidebar');
});

Route::get('vars', function () {
    dump("ADMINS");
    foreach (Admin::get() as $admin) {
        dump($admin->user->attributesToArray());
    }

    dump("MEDIS");
    foreach (Medis::get() as $medis) {
        dump($medis->user->attributesToArray());
    }

    dump("PASIENS");
    foreach (Pasien::get() as $pasien) {
        dump($pasien->user->attributesToArray());
    }
    
    dump("DEVICES");
    foreach (Device::get() as $device) {
        dump($device->attributesToArray());
    }
});

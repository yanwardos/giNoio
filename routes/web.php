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

    Route::get('profile', [GeneralUserController::class, 'showMyProfile'])->name('profile');

    Route::get('profile/edit', [GeneralUserController::class, 'editMyProfile'])->name('profile.edit');
    Route::post('profile/update', [GeneralUserController::class, 'updateMyProfile'])->name('profile.update');

    Route::get('password/edit', [GeneralUserController::class, 'editMyPassword'])->name('profile.password.edit');
    Route::post('password/update', [GeneralUserController::class, 'updateMyPassword'])->name('profile.password.update');

});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Pasien
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/', [PasienController::class, 'index'])->name('pasien.dashboard');
    Route::get('/terapi', [PasienController::class, 'teraphy'])->name('pasien.teraphy');
    Route::get('/grafik', [PasienController::class, 'teraphyHistory'])->name('pasien.teraphyHistory');
});

// medis
Route::middleware(['auth', 'role:medis'])->prefix('medis')->group(function () {
    Route::get('/', [MedisController::class, 'index'])->name('medis.dashboard');

    // view
    Route::get('/pasiens', [MedisController::class, 'pasienList'])->name('medis.pasien.list');
    Route::get('/pasien/{pasien}/detail', [MedisController::class, 'showPasien'])->name('medis.pasien.show');

    Route::get('/pasien/create', [MedisController::class, 'pasienCreate'])->name('medis.pasien.create');
    Route::post('/pasien/create', [MedisController::class, 'pasienStore'])->name('medis.pasien.store');

    Route::get('/pasien/{pasien}/edit', [MedisController::class, 'pasienEdit'])->name('medis.pasien.edit');
    Route::post('/pasien/{pasien}/update', [MedisController::class, 'pasienUpdate'])->name('medis.pasien.update');
    Route::post('/pasien/{pasien}/delete', [MedisController::class, 'pasienDelete'])->name('medis.pasien.delete');
    Route::post('/pasien/{pasien}/passwordReset', [MedisController::class, 'resetPassword'])->name('medis.pasien.password.reset');

    Route::get('/monitoring', [MedisController::class, 'monitoringIndex'])->name('medis.monitoring.index');
    Route::get('/monitoring/{pasien}', [MedisController::class, 'monitoringShowPasien'])->name('medis.monitoring.show.pasien');

    Route::get('/report', [MedisController::class, 'reportHistoryIndex'])->name('medis.report.index');
    Route::get('/report/{pasien}', [MedisController::class, 'reportHistoryShowPasien'])->name('medis.report.show.pasien');

    Route::get('/devices', [MedisController::class, 'devices'])->name('medis.devices');
    Route::get('/device/{device}/detail', [MedisController::class, 'deviceDetail'])->name('medis.device');

    Route::get('/device/register', [MedisController::class, 'deviceRegister'])->name('medis.deviceRegister');
    Route::post('/device/create', [MedisController::class, 'deviceCreate'])->name('medis.deviceCreate');

    Route::get('/pasien/{pasien}/assign-device', [MedisController::class, 'pasienAssignDevice'])->name('medis.pasien.assignDevice');
    Route::post('/pasien/assign-device', [MedisController::class, 'pasienAssignDeviceStore'])->name('medis.pasien.assignDevice.store');
    Route::post('/pasien/unassign-device', [MedisController::class, 'pasienUnassignDeviceStore'])->name('medis.pasien.unassignDevice.store');

    Route::get('/device/{device}/assign-pasien', [MedisController::class, 'assignPasienToDevice'])->name('medis.device.assignPasien');
    Route::post('/device/{device}/assign-pasien', [MedisController::class, 'assignPasienToDeviceStore'])->name('medis.device.assignPasien.store');
    Route::post('/device/{device}/unassign-pasien', [MedisController::class, 'unAssignPasienToDeviceStore'])->name('medis.device.unassignDevice.store');
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

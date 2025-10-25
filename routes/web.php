<?php

use App\Models\Perdin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sdm\SdmController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Pegawai\PerdinController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Pegawai\PegawaiDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Dashboard umum (jika ingin, bisa dihapus kalau hanya pakai admin/pegawai)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');
        //Data User    
        Route::get('/admin/data_user', [UserController::class, 'index'])
            ->name('admin.data_user');
        Route::get('admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::delete('admin/user/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');
        Route::get('admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('admin/user/{id}/update', [UserController::class, 'update'])->name('admin.user.update');
        //Data Kota
        Route::get('/admin/data_kota', [CitiesController::class, 'index'])
            ->name('admin.data_kota');
        Route::get('admin/data_kota/create', [CitiesController::class, 'create'])->name('admin.kota.create');
        Route::post('admin/data_kota/store', [CitiesController::class, 'store'])->name('admin.store');
        Route::delete('admin/data_kota/delete/{id}', [CitiesController::class, 'destroy'])->name('admin.user.delete');
        Route::get('admin/data_kota/{id}/edit', [CitiesController::class, 'edit'])->name('admin.edit');
        Route::put('admin/data_kota/{id}/update', [CitiesController::class, 'update'])->name('admin.update');
    });

    Route::middleware('role:pegawai')->group(function () {
        // Dashboard
        // Daftar perdin
        Route::get('/pegawai/dashboard', [PerdinController::class, 'index'])
            ->name('pegawai.dashboard');

        // Form tambah perdin
        Route::get('/pegawai/perdin/create', [PerdinController::class, 'create'])
            ->name('pegawai.perdin.create');

        // Simpan data perdin
        Route::post('/pegawai/perdin/store', [PerdinController::class, 'store'])
            ->name('pegawai.perdin.store');
    });

    // Dashboard sdm
    // Route::middleware('role:sdm')->group(function () {
    //     Route::get('/sdm/dashboard', [SdmController::class, 'index'])
    //         ->name('sdm.dashboard');
    // });

    // Dashboard SDM
    Route::middleware('role:sdm')->group(function () {
        Route::get('/sdm/dashboard', [PerdinController::class, 'indexSdm'])->name('sdm.dashboard');
        Route::get('/sdm/history', [PerdinController::class, 'indexhistory'])->name('sdm.history');
        Route::post('/sdm/perdin/{id}/approve', [PerdinController::class, 'approve'])->name('sdm.perdin.approve');
        Route::post('/sdm/perdin/{id}/reject', [PerdinController::class, 'reject'])->name('sdm.perdin.reject');
    });
});

require __DIR__ . '/auth.php';

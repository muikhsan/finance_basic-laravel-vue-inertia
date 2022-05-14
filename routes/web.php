<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth','verified'])->group(function() {
    
    Route::resource('dashboard', DashboardController::class);

    Route::resource('laporan', LaporanController::class);

    Route::get('/generate-pdf', [LaporanController::class, 'generatepdf'])->name('generate-pdf');
    
    Route::resource('pemasukans', PemasukanController::class);

    Route::resource('pengeluarans', PengeluaranController::class);

});


require __DIR__.'/auth.php';
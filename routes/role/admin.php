<?php

use App\Http\Controllers\Admin\AgendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\master\InstansiController;
use App\Http\Controllers\admin\master\KategoriController;
use App\Http\Controllers\admin\master\LokasiController;
use App\Http\Controllers\admin\master\UnitController;
use App\Http\Controllers\Admin\MasterDataController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'toDashboard'])->name('dashboard');
    // Route::get('/dashboard/{data}', [DashboardController::class, 'show'])->name('dashboard.show');

    Route::get('/user-management', [UserController::class, 'index'])->name('user-management.index');
    Route::post('/user-management/create', [UserController::class, 'store'])
    ->name('user-management.store');
    Route::put('/user-management/{data}/update', [UserController::class, 'update'])->name('user-management.update');
    Route::delete('/user-management/{data}/delete', [UserController::class, 'destroy'])->name('user-management.destroy');
    // Route::get('/user-management/create', [UserController::class, 'create'])->name('user-management.create');
    // Route::post('/user-management/create', [UserController::class, 'store'])->name('user-management.store');
    // Route::get('/user-management/{data}/show', [UserController::class, 'show'])->name('user-management.show');
    // Route::get('/user-management/{data}/edit', [UserController::class, 'edit'])->name('user-management.edit');
    // Route::put('/user-management/{data}/update', [UserController::class, 'update'])->name('user-management.update');
    // Route::delete('/user-management/{data}/delete', [UserController::class, 'destroy'])->name('user-management.destroy');

    // Route::resource('dataKategori', KategoriController::class);  
    
    // Route::resource('dataLokasi', LokasiController::class);  
    
    // Route::resource('dataInstansi',InstansiController::class);

    // Route::resource('dataUnit', UnitController::class);

    // Route::get('/data-agenda', [AgendaController::class, 'index'])->name('data-agenda.index');
    // Route::get('/data-agenda/{data}/show', [AgendaController::class, 'show'])->name('data-agenda.show');
    // Route::get('/data-agenda/{data}/edit', [AgendaController::class, 'edit'])->name('data-agenda.edit');
    // Route::put('/data-agenda/{data}/update', [AgendaController::class, 'update'])->name('data-agenda.update');
    // Route::delete('/data-agenda/{data}/delete', [AgendaController::class, 'destroy'])->name('data-agenda.destroy');
    

});
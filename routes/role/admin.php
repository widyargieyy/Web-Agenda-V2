<?php

use App\Http\Controllers\Admin\AgendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\admin\master\InstansiController;
use App\Http\Controllers\admin\master\KategoriController;
use App\Http\Controllers\admin\master\LokasiController;
use App\Http\Controllers\admin\master\UnitController;
use App\Http\Controllers\Admin\MasterDataController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Master\CategoryController;

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'toDashboard'])->name('dashboard');
    // Route::get('/dashboard/{data}', [DashboardController::class, 'show'])->name('dashboard.show');

    Route::get('/user-management', [UserController::class, 'index'])->name('user-management.index');
    Route::post('/user-management/create', [UserController::class, 'store'])->name('user-management.store');
    Route::put('/user-management/{data}/update', [UserController::class, 'update'])->name('user-management.update');
    Route::delete('/user-management/{data}/delete', [UserController::class, 'destroy'])->name('user-management.destroy');

    Route::get('/data-kategori', [CategoryController::class, 'index'])->name('data-kategori.index');
    Route::post('/data-kategori/create', [CategoryController::class, 'store'])->name('data-kategori.store');
    Route::put('/data-kategori/{category}/update', [CategoryController::class, 'update'])->name('data-kategori.update');
    Route::delete('/data-kategori/{category}/delete', [CategoryController::class, 'destroy'])->name('data-kategori.destroy');
    
    Route::get('/data-agenda', [AgendaController::class, 'index'])->name('data-agenda.index');
    Route::get('/data-agenda/{data}/show', [AgendaController::class, 'show'])->name('data-agenda.show');
    Route::get('/data-agenda/{data}/edit', [AgendaController::class, 'edit'])->name('data-agenda.edit');
    Route::put('/data-agenda/{data}/update', [AgendaController::class, 'update'])->name('data-agenda.update');
    Route::delete('/data-agenda/{data}/delete', [AgendaController::class, 'destroy'])->name('data-agenda.destroy');
    

});
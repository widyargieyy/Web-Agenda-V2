<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Operator\AgendaController;
use App\Http\Controllers\Operator\DashboardController;
use App\Http\Controllers\Operator\PrintController;

Route::prefix('operator')->name('operator.')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'toDashboard'])->name('dashboard');

    Route::get('/buat-agenda', [AgendaController::class, 'create'])->name('buat-agenda.create');
    Route::post('/buat-agenda', [AgendaController::class, 'store'])->name('buat-agenda.store');
    
    Route::get('/agenda-saya', [AgendaController::class, 'index'])->name('agenda-saya.index');
    Route::get('/agenda-saya/{data}/detail', [AgendaController::class, 'show'])->name('agenda-saya.show');
    Route::patch('/agenda-saya/{data}/kirim', [AgendaController::class, 'kirim'])->name('agenda-saya.kirim');
    Route::get('/agenda-saya/{data}/edit', [AgendaController::class, 'edit'])->name('agenda-saya.edit');
    Route::put('/agenda-saya/{data}/update', [AgendaController::class, 'update'])->name('agenda-saya.update');
    Route::delete('/agenda-saya/{data}/destroy', [AgendaController::class, 'destroy'])->name('agenda-saya.destroy');
    // Route::get('/agenda-saya-export', [AgendaController::class, 'exportExcel'])->name('agenda-saya.export');
    
    // Route::get('/cetak-agenda', [PrintController::class, 'index'])->name('cetak-agenda.index');
});
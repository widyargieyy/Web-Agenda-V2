<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Staff\AgendaController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\DocumentationController;
use Illuminate\Support\Facades\Route;

Route::prefix('staff')->name('staff.')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'toDashboard'])->name('dashboard');

    Route::get('/data-agenda', [AgendaController::class, 'index'])->name('data-agenda');
    Route::get('/data-agenda/{data}/detail', [AgendaController::class, 'show'])->name('data-agenda.detail');
    Route::post('/data-agenda/{data}/upload-dokumentasi', [AgendaController::class, 'uploadDocumentation'])->name('data-agenda.upload');

    
    // Route::get('/dashboard/{data}/detail', [DashboardController::class, 'toDetail'])->name('dashboard.detail');
    
    // Route::get('/daftar-agenda', [AgendaController::class, 'index'])->name('daftar-agenda');
    // Route::get('/daftar-agenda/{data}/detail', [AgendaController::class, 'show'])->name('daftar-agenda.detail');
    
    // Route::get('/dokumentasi-kegiatan', [DocumentationController::class, 'index'])->name('dokumentasi-kegiatan');
    // Route::post('/dokumentasi-kegiatan', [DocumentationController::class, 'addDocumentation'])->name('dokumentasi-kegiatan.post');
    
    // Route::get('/dokumentasi-kegiatan/{data}/detail', [DocumentationController::class, 'show'])->name('dokumentasi-kegiatan.detail');
    // Route::get('/dokumentasi-kegiatan/{data}/upload-dokumentasi', [DocumentationController::class, 'uploadDocumentation'])->name('dokumentasi-kegiatan.upload');
    // Route::patch('/dokumentasi-kegiatan/{data}/selesaikan', [DocumentationController::class, 'selesaikanAgenda'])->name('dokumentasi-kegiatan.selesaikan');
    // Route::delete('/dokumentasi-kegiatan/{data}/hapus', [DocumentationController::class, 'destroy'])->name('dokumentasi-kegiatan.hapus');


});
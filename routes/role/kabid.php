<?php

use App\Http\Controllers\Kabid\ApprovalController;
use App\Http\Controllers\Kabid\ApproveController;
use App\Http\Controllers\Kabid\CompletedController;
use App\Http\Controllers\kabid\DaftarAgendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kabid\DashboardController;
use App\Http\Controllers\kabid\MonthlyController;
use App\Http\Controllers\kabid\PendingController;
use App\Http\Controllers\Kabid\RiwayatController;

Route::prefix('kabid')->name('kabid.')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard/{data}', [DashboardController::class, 'show'])->name('dashboard.detail');

    Route::get('/agenda-pending', [ApprovalController::class, 'index'])->name('approval.index');
    Route::get('/agenda-pending/{data}', [ApprovalController::class, 'show'])->name('approval.show');
    Route::patch('/agenda/{data}/approve', [ApprovalController::class, 'approve'])->name('approval.approve');
    Route::patch('/agenda/{data}/reject', [ApprovalController::class, 'reject'])->name('approval.reject');
    
    Route::get('/agenda-disetujui', [CompletedController::class, 'index'])->name('completed.index');
    Route::get('/agenda-disetujui/{data}', [CompletedController::class, 'show'])->name('completed.show');
    Route::patch('/agenda-disetujui/{data}/complete', [CompletedController::class, 'complete'])->name('completed.complete');
    Route::patch('/agenda-disetujui/{data}/cancelled', [CompletedController::class, 'cancelled'])->name('completed.cancelled');

    Route::get('/riwayat-agenda', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat-agenda/{data}/detail', [RiwayatController::class, 'show'])->name('riwayat.show');
    
    // Route::get('/agenda-disetujui', [ApproveController::class, 'index'])->name('approved.index');\
    // Route::get('/agenda-disetujui/{data}', [ApproveController::class, 'show'])->name('approved.show');
    // Route::patch('/agenda-disetujui/{data}/complete', [ApproveController::class, 'complete'])->name('approved.complete');
    // Route::patch('/agenda-disetujui/{data}/reject', [ApproveController::class, 'reject'])->name('approved.reject');

    // Route::get('/daftar-agenda', [DaftarAgendaController::class, 'index'])->name('daftar-agenda.index');
    // Route::get('/daftar-agenda/{data}/detail', [DaftarAgendaController::class, 'show'])->name('daftar-agenda.show');
    
    // Route::get('/agenda-bulanan', [MonthlyController::class, 'index'])->name('agenda-bulanan.index');
});
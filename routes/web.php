<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Auth\AuthController;

// Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'toLogin'])->name('login');
    Route::post('/', [AuthController::class, 'loginProses'])->name('login-proses');
// });
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    require __DIR__ . '/role/admin.php';
    require __DIR__ . '/role/staff.php';
    require __DIR__ . '/role/kabid.php';
    require __DIR__ . '/role/operator.php';
});

Route::get('/test', function(){
    
});
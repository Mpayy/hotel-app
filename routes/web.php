<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;




Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Semua karyawan bisa masuk ke Dashboard & Kamar
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/rooms', [RoomController::class, 'index'])->middleware(['auth'])->name('rooms.index');

// HANYA Admin dan Receptionist yang bisa mengelola pendaftaran & Pembayaran
Route::middleware(['auth', 'role:admin,resepsionist'])->group(function () {
    Route::resource('registration', RegistrationController::class);
    Route::get('/registration/{id}/print', [RegistrationController::class, 'print'])->name('registration.print');
    Route::get('/registration/{id}/checkout', [RegistrationController::class,'checkout'])->name('registration.checkout');
    
    Route::get('/payments/create/{registration_id}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
});

// HANYA Admin dan Housekeeping yang dapat membersihkan kamar
Route::middleware(['auth', 'role:admin,housekeeping'])->group(function () {
    Route::post('/rooms/{id}/clean', [RoomController::class, 'setClean'])->name('rooms.clean');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

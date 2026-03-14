<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Models\Registration;
use App\Models\Room;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    // Menghitung statistik sederhana untuk ditampilkan
    $totalRooms = Room::count();
    $availableRooms = Room::where('status', 'available')->count();
    $unpaidRegistrations = Registration::where('payment_status', 'Unpaid')->count();
    $totalRevenue = Payment::sum('total_bill'); // Total pendapatan
    
    // Mengambil 5 pendaftaran terbaru
    $recentRegistrations = Registration::with(['guest', 'room'])->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalRooms', 
        'availableRooms', 
        'unpaidRegistrations', 
        'totalRevenue', 
        'recentRegistrations'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('registration', RegistrationController::class);
Route::get('/registration/{id}/print', [RegistrationController::class, 'print'])->name('registration.print');

Route::get('/payments/create/{registration_id}', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
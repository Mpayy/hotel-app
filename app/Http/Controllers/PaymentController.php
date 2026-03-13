<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // 1. Menampilkan Form Pembayaran
    public function create($registration_id)
    {
        // Ambil data registrasi beserta relasi kamar dan tamu
        $registration = Registration::with(['room', 'guest'])->findOrFail($registration_id);

        // Logika Hitung Malam (Sama seperti di fitur Print)
        // $checkIn = Carbon::parse($registration->arrival_time);
        // $checkOut = Carbon::parse($registration->departure_date);
        $nights = ceil($registration->arrival_time->diffInDays($registration->departure_date, false));
        // if ($nights == 0) $nights = 1;

        // Hitung Total Tagihan
        $totalBill = $registration->room->price * $nights;

        return view('payments.create', compact('registration', 'totalBill', 'nights'));
    }

    // 2. Menyimpan Data Pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        // Hitung Kembalian (Balance)
        $balance = $request->amount_paid - $request->total_bill;

        // Generate Nomor Kwitansi Otomatis (Contoh: INV-20260313-0001)
        $receiptNumber = 'INV-' . date('Ymd') . '-' . str_pad($request->registration_id, 4, '0', STR_PAD_LEFT);

        // Simpan ke Database
        Payment::create([
            'registration_id' => $request->registration_id,
            'total_bill' => $request->total_bill,
            'amount_paid' => $request->amount_paid,
            'balance' => $balance,
            'payment_method' => $request->payment_method,
            'receipt_number' => $receiptNumber,
        ]);

        // 2. UPDATE status di tabel registrations
        $registration = Registration::find($request->registration_id);
        $registration->update([
            'payment_status' => 'Paid'
        ]);

        return redirect()->route('registration.index')->with('success', 'Pembayaran berhasil disimpan dengan nomor: ' . $receiptNumber);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Registration;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data registrasi beserta relasinya (kamar, tamu, dan user/petugas)
        // with() digunakan agar query lebih cepat (Eager Loading)
        // latest() untuk mengurutkan dari yang terbaru
        $registrations = Registration::with(['room', 'guest', 'user'])->latest()->get();

        return view('registration.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hanya ambil kamar yang statusnya 'available'
        $rooms = Room::where('status', 'available')->get();

        return view('registration.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input: Pastikan tidak ada data penting yang kosong
        $request->validate([
            'room_id' => 'required',
            'arrival_time' => 'required|date',
            'departure_date' => 'required|date',
            'no_of_person' => 'required|integer',
            'name' => 'required|string|max:255',
            'id_card_number' => 'required|string',
            'phone' => 'required|string',
        ]);

        // 2. Simpan Data Tamu ke tabel `guests`
        $guest = Guest::create([
            'name' => $request->name,
            'profession' => $request->profession,
            'company' => $request->company,
            'nationality' => $request->nationality,
            'birth_date' => $request->birth_date,
            'id_card_number' => $request->id_card_number,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // 3. Simpan Data Pendaftaran ke tabel `registrations`
        Registration::create([
            'guest_id' => $guest->id, // Diambil dari ID tamu yang baru saja dibuat di atas
            'room_id' => $request->room_id,
            'user_id' => Auth::id(), // Mengambil ID resepsionis yang sedang login
            'no_of_person' => $request->no_of_person,
            'arrival_time' => $request->arrival_time,
            'departure_date' => $request->departure_date,
            'receptionist_name' => Auth::user()->name, // Jika kamu masih mempertahankan field ini
        ]);

        // 4. Update Status Kamar menjadi 'occupied' (Terisi)
        Room::where('id', $request->room_id)->update(['status' => 'occupied']);

        // 5. Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('registration.index')->with('success', 'Tamu berhasil Check-In!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil 1 data registrasi lengkap dengan relasinya
        $registration = \App\Models\Registration::with(['guest', 'room', 'user'])->findOrFail($id);

        // Kirim ke halaman show.blade.php
        return view('registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari data pendaftaran berdasarkan ID, jika tidak ada akan error 404
        $registration = Registration::with('guest', 'room')->findOrFail($id);

        $rooms = Room::where('status', 'available')
                 ->orWhere('id', $registration->room_id)
                 ->get();

        return view('registration.edit', compact('registration','rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $registration = Registration::findOrFail($id);

        // Simpan ID kamar lama sebelum diupdate
    $oldRoomId = $registration->room_id;
    $newRoomId = $request->room_id;

        // Update data di tabel pendaftaran
        $registration->update([
            'room_id' => $newRoomId,
            'user_id' => Auth::id(), // Mengambil ID resepsionis yang sedang login
            'no_of_person' => $request->no_of_person,
            'arrival_time' => $request->arrival_time,
            'departure_date' => $request->departure_date,
            'receptionist_name' => Auth::user()->name,
        ]);

        // Update data di tabel tamu yang berelasi
        $registration->guest->update([
            'name' => $request->name,
            'profession' => $request->profession,
            'company' => $request->company,
            'nationality' => $request->nationality,
            'birth_date' => $request->birth_date,
            'id_card_number' => $request->id_card_number,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // 2. LOGIKA PINDAH KAMAR: Cek apakah user mengganti nomor kamar?
    if ($oldRoomId != $newRoomId) {
        // Kamar Lama: Ubah status kembali jadi 'available'
        Room::where('id', $oldRoomId)->update(['status' => 'available']);

        // Kamar Baru: Ubah status jadi 'occupied'
        Room::where('id', $newRoomId)->update(['status' => 'occupied']);
    }

        return redirect()->route('registration.index')->with('success', 'Data pendaftaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registration = Registration::findOrFail($id);
        
        // Sebelum pendaftaran dihapus, ubah dulu status kamar menjadi 'available'
        Room::where('id', $registration->room_id)->update(['status' => 'available']);

        // Hapus pendaftaran
        $registration->delete();

        return redirect()->route('registration.index')->with('success', 'Data berhasil dihapus dan kamar kembali kosong.');
    }

    public function print($id)
    {
        $registration = Registration::with(['guest', 'room', 'user'])->findOrFail($id);

        return view('registration.print', compact('registration'));
    }
}

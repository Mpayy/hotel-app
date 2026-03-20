<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Registration;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Registration Data";
        $registrations = Registration::with(['room', 'guest', 'user'])->latest()->get();

        return view('registration.index', compact('registrations', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::where('status', 'available')->get();

        return view('registration.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistrationRequest $request)
    {
        DB::transaction(function () use ($request) {
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

            Registration::create([
                'guest_id' => $guest->id,
                'room_id' => $request->room_id,
                'user_id' => Auth::id(),
                'no_of_person' => $request->no_of_person,
                'arrival_time' => $request->arrival_time,
                'departure_date' => $request->departure_date,
                'receptionist_name' => Auth::user()->name,
            ]);

            Room::where('id', $request->room_id)->update(['status' => Room::STATUS_OCCUPIED]);
        });

        return redirect()->route('registration.index')->with('success', 'Tamu berhasil Check-In!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registration = Registration::with(['guest', 'room', 'user'])->findOrFail($id);

        return view('registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $registration = Registration::with('guest', 'room')->findOrFail($id);
        $rooms = Room::where('status', 'available')->orWhere('id', $registration->room_id)->get();

        return view('registration.edit', compact('registration','rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistrationRequest $request, string $id)
    {
        DB::transaction(function () use ($request, $id) {
            $registration = Registration::findOrFail($id);
            $oldRoomId = $registration->room_id;
            $newRoomId = $request->room_id;
            
            $registration->update([
                'room_id' => $newRoomId,
                'user_id' => Auth::id(),
                'no_of_person' => $request->no_of_person,
                'arrival_time' => $request->arrival_time,
                'departure_date' => $request->departure_date,
                'receptionist_name' => Auth::user()->name,
            ]);

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

            if ($oldRoomId != $newRoomId) {
                Room::where('id', $oldRoomId)->update(['status' => Room::STATUS_AVAILABLE]);
                Room::where('id', $newRoomId)->update(['status' => Room::STATUS_OCCUPIED]);
            }
        });

        return redirect()->route('registration.index')->with('success', 'Data pendaftaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registration = Registration::findOrFail($id);
        
        Room::where('id', $registration->room_id)->update(['status' => Room::STATUS_AVAILABLE]);
        $registration->delete();

        return redirect()->route('registration.index')->with('success', 'Data berhasil dihapus dan kamar kembali kosong.');
    }

    public function print($id)
    {
        $registration = Registration::with(['guest', 'room', 'user'])->findOrFail($id);

        return view('registration.print', compact('registration'));
    }

    public function checkout($id)
    {
        $registration = Registration::findOrFail($id);
        Room::where('id', $registration->room_id)->update(['status' => Room::STATUS_DIRTY]);

        return redirect()->route('registration.index')->with('success', 'Tamu berhasil Check-Out!, Status Kamar: KOTOR (Perlu dibersihkan).');
    }

    
}

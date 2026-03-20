<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(10);
        return view('rooms.index', compact('rooms'));
    }

    public function setClean($id)
    {
        $room = Room::findOrFail($id);
        $room->update(['status' => 'available']);
        return redirect()->route('rooms.index')->with('success', 'Kamar sudah dibersihkan!');
    }
}

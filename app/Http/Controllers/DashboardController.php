<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Registration;
use App\Models\Room;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', Room::STATUS_AVAILABLE)->count();
        $occupiedRooms = Room::where('status', Room::STATUS_OCCUPIED)->count();
        $dirtyRooms = Room::where('status', Room::STATUS_DIRTY)->count();
        $unpaidRegistrations = Registration::where('payment_status', 'Unpaid')->count();
        $totalRevenue = Payment::sum('total_bill'); // Total pendapatan
        
        $recentRegistrations = Registration::with(['guest', 'room'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalRooms', 
            'availableRooms', 
            'occupiedRooms', 
            'dirtyRooms', 
            'unpaidRegistrations', 
            'totalRevenue', 
            'recentRegistrations'
        ));
    }
}

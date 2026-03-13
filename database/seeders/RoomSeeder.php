<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'room_number' => '0601',
            'room_type' => 'Standard',
            'price' => 750000,
            'status' => 'available'
        ]);

        Room::create([
            'room_number' => '0602',
            'room_type' => 'Standard',
            'price' => 750000,
            'status' => 'available'
        ]);

        Room::create([
            'room_number' => '0701',
            'room_type' => 'Deluxe',
            'price' => 1200000,
            'status' => 'available'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Resepsionis',
            'email' => 'resepsionis@gmail.com',
            'role' => 'resepsionist',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Housekeeping',
            'email' => 'housekeeping@gmail.com',
            'role' => 'housekeeping',
            'password' => Hash::make('12345678'),
        ]);
    }
}

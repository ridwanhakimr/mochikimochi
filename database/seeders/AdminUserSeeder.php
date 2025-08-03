<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'RidwanHR',
            'username' => 'ridwanhr',
            'email' => 'ridwanhakimr@gmail.com',
            'password' => Hash::make('ridwanhr123'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'AziTriyadi',
            'username' => 'azitriyadi',
            'email' => 'azitriyadi@gmail.com',
            'password' => Hash::make('azitriyadi123'),
            'is_admin' => true,
        ]);
    }
}

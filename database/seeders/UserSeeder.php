<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
            'email' => 'admin@santara.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Pengusaha',
            'email' => 'pengusaha@santara.com',
            'password' => Hash::make('pengusaha123'),
            'role' => 'pengusaha',
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@santara.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}

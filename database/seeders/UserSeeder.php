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
            'name' => 'User',
            'email' => 'user@santara.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        
        // Create multiple pengusaha users
        $pengusahaData = [
            [
                'name' => 'Pak Yono',
                'email' => 'yono@pengusaha.com',
                'password' => Hash::make('pengusaha123'),
                'role' => 'pengusaha',
            ],
            [
                'name' => 'Ibu Djum',
                'email' => 'djum@pengusaha.com',
                'password' => Hash::make('pengusaha123'),
                'role' => 'pengusaha',
            ],
            [
                'name' => 'Pak Darmo',
                'email' => 'darmo@pengusaha.com',
                'password' => Hash::make('pengusaha123'),
                'role' => 'pengusaha',
            ],
            [
                'name' => 'Bu Imas',
                'email' => 'imas@pengusaha.com',
                'password' => Hash::make('pengusaha123'),
                'role' => 'pengusaha',
            ],
            [
                'name' => 'Pak Kumis',
                'email' => 'kumis@pengusaha.com',
                'password' => Hash::make('pengusaha123'),
                'role' => 'pengusaha',
            ],
            [
                'name' => 'Bu Tini',
                'email' => 'tini@pengusaha.com',
                'password' => Hash::make('pengusaha123'),
                'role' => 'pengusaha',
            ],
            [
                'name' => 'Pak Hasan',
                'email' => 'hasan@pengusaha.com',
                'password' => Hash::make('pengusaha123'),
                'role' => 'pengusaha',
            ],
            [
                'name' => 'Bu Tinah',
                'email' => 'tinah@pengusaha.com',
                'password' => Hash::make('pengusaha123'),
                'role' => 'pengusaha',
            ]
        ];


        foreach($pengusahaData as $pengusaha) {
            User::create($pengusaha);
        }
    }
}

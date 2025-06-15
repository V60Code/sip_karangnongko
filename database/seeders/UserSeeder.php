<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Farm;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tambahkan dua farm dulu
        // Gunakan firstOrCreate untuk menghindari duplikasi jika seeder dijalankan berkali-kali
        $farmBarat = Farm::firstOrCreate(
            ['name' => 'Barat'],
            ['location' => 'Kandang Barat']
        );

        $farmTimur = Farm::firstOrCreate(
            ['name' => 'Timur'],
            ['location' => 'Kandang Timur']
        );

        // Admin
        User::firstOrCreate(
            ['email' => 'admin@karangnongko.id'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // Ganti dengan password yang kuat
                'role' => 'admin',
                'farm_id' => null,
                'email_verified_at' => now(),
            ]
        );

        // Peternak Barat (Contoh Awal)
        User::firstOrCreate(
            ['email' => 'barat@karangnongko.id'],
            [
                'name' => 'barat', // Nama user contoh
                'password' => Hash::make('password'), // Ganti dengan password yang kuat
                'role' => 'barat',
                'farm_id' => $farmBarat->id,
                'email_verified_at' => now(),
            ]
        );

        // Peternak Timur (Contoh Awal)
        User::firstOrCreate(
            ['email' => 'timur@karangnongko.id'],
            [
                'name' => 'timur', // Nama user contoh
                'password' => Hash::make('password'), // Ganti dengan password yang kuat
                'role' => 'timur',
                'farm_id' => $farmTimur->id,
                'email_verified_at' => now(),
            ]
        );

        // --- Tambahan Pengguna Baru ---

        // Pengguna untuk Role Barat
        $newBaratUsers = [
            ['name' => 'samsuhadi'],
            ['name' => 'sigit'],
            ['name' => 'suwarno'],
            ['name' => 'suranto'],
            ['name' => 'dwi'],
            ['name' => 'susanto'],
            ['name' => 'sajadi'],
        ];

        foreach ($newBaratUsers as $userData) {
            User::firstOrCreate(
                ['email' => strtolower($userData['name']) . '@karangnongko.id'],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('peternakjaya'),
                    'role' => 'barat',
                    'farm_id' => $farmBarat->id,
                    'email_verified_at' => now(),
                ]
            );
        }

        // Pengguna untuk Role Timur
        $newTimurUsers = [
            ['name' => 'suliman'],
        ];

        foreach ($newTimurUsers as $userData) {
            User::firstOrCreate(
                ['email' => strtolower($userData['name']) . '@karangnongko.id'],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('peternakjaya'),
                    'role' => 'timur',
                    'farm_id' => $farmTimur->id,
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
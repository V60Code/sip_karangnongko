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
        $farmBarat = Farm::create([
            'name' => 'Barat',
            'location' => 'Kandang Barat'
        ]);

        $farmTimur = Farm::create([
            'name' => 'Timur',
            'location' => 'Kandang Timur'
        ]);

        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@karangnongko.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'farm_id' => null,
        ]);

        // Peternak Barat
        User::create([
            'name' => 'barat',
            'email' => 'barat@karangnongko.id',
            'password' => Hash::make('password'),
            'role' => 'barat',
            'farm_id' => $farmBarat->id,
        ]);

        // Peternak Timur
        User::create([
            'name' => 'timur',
            'email' => 'timur@karangnongko.id',
            'password' => Hash::make('password'),
            'role' => 'timur',
            'farm_id' => $farmTimur->id,
        ]);
    }
}

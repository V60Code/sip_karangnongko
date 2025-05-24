<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Jalankan UserSeeder
        $this->call([
            UserSeeder::class,
        ]);
    }
}

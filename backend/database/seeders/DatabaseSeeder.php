<?php

namespace Database\Seeders;

use App\Models\paket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        paket::create([
            'nama_paket' => 'Paket A',
            'harga' => 100000,
            'deskripsi' => 'Paket A adalah paket yang paling murah',
        ]);

        paket::create([
            'nama_paket' => 'Paket B',
            'harga' => 200000,
            'deskripsi' => 'Paket B adalah paket yang paling mahal',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

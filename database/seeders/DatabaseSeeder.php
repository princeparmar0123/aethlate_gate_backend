<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'mobile' => '1234567890',
            'email' => 'admin@gmail.com',
            'type' => 'admin',
            'password' => Hash::make('Admin@123'),
        ]);
    }
}

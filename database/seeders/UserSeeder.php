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
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'pemimpin',
            'email' => 'pemimpin@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'pemimpin'
        ]);

        User::factory()->create([
            'name' => 'distributor',
            'email' => 'distributor@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'distributor'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@bestwatch.com',
            'password' => Hash::make('Skills39'), // Change this for production!
            'role_id' => 1, // Assumes 1 = admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

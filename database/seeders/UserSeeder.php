<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'branch_id' => 1,
            'name' => "Shourab",
            'email' => "shourab.cit.bd@gmail.com",
            'password' => Hash::make('password'),
        ]);
    }
}

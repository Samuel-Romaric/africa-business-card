<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin test 
        User::create([
            'name' => 'Romaric',
            'email'=> 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}

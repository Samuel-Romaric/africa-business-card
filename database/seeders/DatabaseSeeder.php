<?php

namespace Database\Seeders;

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
        $this->call(AdminSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(ProductSeeder::class);
        // $this->call(SaleSeeder::class);
    }
}

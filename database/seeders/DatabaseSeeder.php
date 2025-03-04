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
        $this->call(ActivitySeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(CommercialSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(OfferSeeder::class);
        // // $this->call(SaleSeeder::class);
    }
}

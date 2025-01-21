<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sales = [
            [
                'code' => 'CO-101',
                'amount_recieved' => '',
                'product_id' => 1,
                'business_id' => 1,
                'manager_id' => 1,
            ],
            [
                'code' => 'CO-101',
                'amount_recieved' => '',
                'product_id' => 2,
                'business_id' => 3,
                'manager_id' => 1,
            ],
            [
                'code' => 'CO-101',
                'amount_recieved' => '',
                'product_id' => 3,
                'business_id' => 3,
                'manager_id' => 5,
            ],
            [
                'code' => 'CO-101',
                'amount_recieved' => '',
                'product_id' => 4,
                'business_id' => 4,
                'manager_id' => 8,
            ],
        ];

        foreach ($sales as $key => $value) {
            Sale::create($value);
        }
    }
}

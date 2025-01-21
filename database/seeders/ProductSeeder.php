<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            [
                'name' => 'Canadolie',
                'slug' => Str::slug('Canadolie'),
                'quantity' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'price' => '20000',
                'business_id' => 1,
                'manager_id' => 1,
            ],
            [
                'name' => 'Busirol',
                'slug' => Str::slug('Busirol'),
                'quantity' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'price' => '50000',
                'business_id' => 1,
                'manager_id' => 1,
            ],
            [
                'name' => 'Producil',
                'slug' => Str::slug('Producil'),
                'quantity' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'price' => '15000',
                'business_id' => 2,
                'manager_id' => 2,
            ],
            [
                'name' => 'Panadoline',
                'slug' => Str::slug('Panadoline'),
                'quantity' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'price' => '25000',
                'business_id' => 2,
                'manager_id' => 2,
            ],
            [
                'name' => 'Shorotte',
                'slug' => Str::slug('Shorotte'),
                'quantity' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'price' => '23000',
                'business_id' => 3,
                'manager_id' => 3,
            ],
            [
                'name' => 'Zamiride',
                'slug' => Str::slug('Zamiride'),
                'quantity' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'price' => '40000',
                'business_id' => 3,
                'manager_id' => 3,
            ],
            [
                'name' => 'Bourgote',
                'slug' => Str::slug('Bourgote'),
                'quantity' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'price' => '17000',
                'business_id' => 4,
                'manager_id' => 4,
            ],
            [
                'name' => 'Moziladine',
                'slug' => Str::slug('Moziladine'),
                'quantity' => 3,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'price' => '20000',
                'business_id' => 4,
                'manager_id' => 4,
            ],
        ];


        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}

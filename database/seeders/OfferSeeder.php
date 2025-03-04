<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $offers = [
            [
                'titre' => 'Canadolie',
                'slug' => Str::slug('Canadolie'),
                'type' => 'produit',
                'quantite' => 3,
                'price' => '20000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'business_id' => 1,
                'user_id' => 3,
            ],
            [
                'titre' => 'Busirol',
                'slug' => Str::slug('Busirol'),
                'type' => 'produit',
                'quantite' => 3,
                'price' => '50000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'business_id' => 1,
                'user_id' => 4,
            ],
            [
                'titre' => 'Producil',
                'slug' => Str::slug('Producil'),
                'type' => 'produit',
                'quantite' => 3,
                'price' => '15000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'business_id' => 2,
                'user_id' => 10,
            ],
            [
                'titre' => 'Panadoline',
                'slug' => Str::slug('Panadoline'),
                'type' => 'produit',
                'quantite' => 3,
                'price' => '25000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'business_id' => 1,
                'user_id' => 9,
            ],
            [
                'titre' => 'Shorotte',
                'slug' => Str::slug('Shorotte'),
                'type' => 'produit',
                'quantite' => 3,
                'price' => '23000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'business_id' => 3,
                'user_id' => 6,
            ],
            [
                'titre' => 'Zamiride',
                'slug' => Str::slug('Zamiride'),
                'type' => 'produit',
                'price' => '40000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'business_id' => 3,
                'user_id' => 6,
            ],
            [
                'titre' => 'Bourgote',
                'slug' => Str::slug('Bourgote'),
                'type' => 'produit',
                'quantite' => 3,
                'price' => '17000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'business_id' => 4,
                'user_id' => 4,
            ],
            [
                'titre' => 'Moziladine',
                'slug' => Str::slug('Moziladine'),
                'type' => 'produit',
                'quantite' => 3,
                'price' => '20000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'business_id' => 4,
                'user_id' => 4,
            ],
        ];


        foreach ($offers as $key => $offer) {
            Offer::create($offer);
        }
    }
}

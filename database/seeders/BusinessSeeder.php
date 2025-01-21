<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $businesses = [
            [
                'name' => 'Digital S.A.',
                'slug' => Str::slug('Digital S.A.'),
                'activity' => 'Communication',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'commercial_registrar' => 'RC-00000000',
                'number_of_offers' => '2',
                'is_blocked' => 0,
            ],
            [
                'name' => 'Big Bouffeur',
                'slug' => Str::slug('Big Bouffeur'),
                'activity' => 'Restauration',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'commercial_registrar' => 'RC-00000000',
                'number_of_offers' => '1',
                'is_blocked' => 0,
            ],
            [
                'name' => 'AlloPolice',
                'slug' => Str::slug('AlloPolice'),
                'activity' => 'Jounalisme',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'commercial_registrar' => 'RC-00000000',
                'number_of_offers' => '3',
                'is_blocked' => 0,
            ],
            [
                'name' => 'Air Data Planer',
                'slug' => Str::slug('Air Data Planer'),
                'activity' => 'Technologie',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'commercial_registrar' => 'RC-00000000',
                'number_of_offers' => '2',
                'is_blocked' => 0,
            ],
        ];

        foreach ($businesses as $key => $value) {
            Business::create($value);
        }
    }
}

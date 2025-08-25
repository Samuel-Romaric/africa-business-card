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
                'nom_commercial' => 'Digital S.A.',
                'slug' => Str::slug('Digital S.A.'),
                'forme_juridique' => 'Communication',
                'num_rccm' => 'RC-00000000',
                'reseau' => 'Marketing Relationnel',
                'capital' => '2000000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'is_blocked' => 0,
            ],
            [
                'nom_commercial' => 'Big Bouffeur',
                'slug' => Str::slug('Big Bouffeur'),
                'forme_juridique' => 'Restauration',
                'num_rccm' => 'RC-00000000',
                'reseau' => 'Marketing Transactionnel',
                'capital' => '1500000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'is_blocked' => 0,
            ],
            [
                'nom_commercial' => 'AlloPolice',
                'slug' => Str::slug('AlloPolice'),
                'forme_juridique' => 'Jounalisme',
                'num_rccm' => 'RC-00000000',
                'reseau' => 'Marketing Relationnel',
                'capital' => '5000000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'is_blocked' => 0,
            ],
            [
                'nom_commercial' => 'Air Data Planer',
                'slug' => Str::slug('Air Data Planer'),
                'forme_juridique' => 'Technologie',
                'num_rccm' => 'RC-00000000',
                'reseau' => 'Marketing Transactionnel',
                'capital' => '1000000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'is_blocked' => 0,
            ],
            [
                'nom_commercial' => 'Digital Conception',
                'slug' => Str::slug('Digital Conception'),
                'forme_juridique' => 'Technologie',
                'num_rccm' => 'RC-00000000',
                'reseau' => 'Marketing Relationnel',
                'capital' => '1000000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'is_blocked' => 0,
            ],
        ];

        foreach ($businesses as $key => $value) {
            Business::create($value);
        }
    }
}

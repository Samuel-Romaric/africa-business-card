<?php

namespace Database\Seeders;

use App\Models\ActivitySector;
use App\Models\ActivitySubSector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $activities_sectors = [
            [
                'titre' => 'Seteur tertiaire',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
            ],
            [
                'titre' => 'Seteur primaire',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
            ],
            [
                'titre' => 'Seteur secondaire',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
            ],
            [
                'titre' => 'Premium',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
            ],
        ];

        $activities_sub_sectors = [
            [
                'titre' => 'Agriculture - Pêche - Elevage',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'activity_sectors_id' => 1,
            ],
            [
                'titre' => 'Industrie & Construction',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'activity_sectors_id' => 2,
            ],
            [
                'titre' => 'Commerce & Services',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'activity_sectors_id' => 3,
            ],
            [
                'titre' => 'Primaire-Secondaire-Tertiaire',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'activity_sectors_id' => 4,
            ],
        ];

        // Create activity sectors
        foreach ($activities_sectors as $sector) {
            ActivitySector::create($sector);
        }

        // Create sub sectors 
        foreach ($activities_sub_sectors as $sub_sector) {
            ActivitySubSector::create($sub_sector);
        }
    }
}

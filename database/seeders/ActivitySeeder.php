<?php

namespace Database\Seeders;

use App\Models\ActivitySector;
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
        ];

        foreach ($activities_sectors as $key => $sector) {
            ActivitySector::create($sector);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $managers = [
            [
                'name' => 'Daniel Mousha',
                'email' => 'mousha@business.com',
                'slug' => Str::slug('Daniel Mousha'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'location' => 'Abidjan, Côte d\'Ivoire',
                'business_id' => 1,
                'code' => 'CO-101',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.jpg',
            ],
            [
                'name' => 'Bigolo Hosty',
                'email' => 'hosty@business.com',
                'slug' => Str::slug('Bigolo Hosty'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'location' => 'Paris, France',
                'business_id' => 2,
                'code' => 'CO-101',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.jpg',
            ],
            [
                'name' => 'Maria Doloty',
                'email' => 'doloty@business.com',
                'slug' => Str::slug('Maria Doloty'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'location' => 'Cotonou, Benin',
                'business_id' => 1,
                'code' => 'CO-101',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.jpg',
            ],
            [
                'name' => 'Anicette Baroli',
                'email' => 'boroli@business.com',
                'slug' => Str::slug('Anicette Baroli'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'location' => 'Abidjan, Côte d\Ivoire',
                'business_id' => 2,
                'code' => 'CO-101',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.jpg',
            ],
            [
                'name' => 'Marise Dukobu',
                'email' => 'dukobu@business.com',
                'slug' => Str::slug('Marise Dukobu'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'location' => 'Bouaké, Côte d\Ivoire',
                'business_id' => 3,
                'code' => 'CO-101',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.jpg',
            ],[
                'name' => 'Chancelle Dupied',
                'email' => 'dupeid@business.com',
                'slug' => Str::slug('Chancelle Dupied'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'location' => 'Sans-Pédro, Côte d\'Ivoire',
                'business_id' => 4,
                'code' => 'CO-101',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.jpg',
            ],
            [
                'name' => 'Aladin Timoria',
                'email' => 'timoria@business.com',
                'slug' => Str::slug('Aladin Timoria'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'location' => 'Nice, France',
                'business_id' => 3,
                'code' => 'CO-101',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.jpg',
            ],[
                'name' => 'Daril Placide',
                'email' => 'placide@business.com',
                'slug' => Str::slug('Daril Placide'),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                'location' => 'Los Angeles, USA',
                'business_id' => 4,
                'code' => 'CO-101',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.jpg',
            ],
        ];


        foreach ($managers as $key => $manager) {
            $data = collect($manager)->except('cover');
            $mge = Manager::create($data->toArray());

            $mge->addMedia($manager['cover'])
                   ->preservingOriginal()
                   ->toMediaCollection('cover');
        }
    }
}

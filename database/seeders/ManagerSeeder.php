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
                'type' => 'senior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
            [
                'type' => 'senior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
            [
                'type' => 'junior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
            [
                'type' => 'Junior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
            [
                'type' => 'senior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
            [
                'type' => 'junior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
            [
                'type' => 'senior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
            [
                'type' => 'junior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
        ];


        foreach ($managers as $key => $manager) {
            $data = collect($manager)->except('cover');
            $img = Manager::create($data->toArray());

            $img->addMedia($manager['cover'])
                   ->preservingOriginal()
                   ->toMediaCollection('cover');
        }
    }
}

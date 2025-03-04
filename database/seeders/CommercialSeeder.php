<?php

namespace Database\Seeders;

use App\Models\Commercial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommercialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $commercials = [
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
                'type' => 'junior',
                'cover' => public_path() . '/admin/assets/img/boxed-bg.png',
            ],
        ];

        foreach ($commercials as $key => $commercial) {
            $data = collect($commercial)->except('cover');
            $cover = Commercial::create($data->toArray());

            $cover->addMedia($commercial['cover'])
                  ->preservingOriginal()
                  ->toMediaCollection();
        }
    }
}

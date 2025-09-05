<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        Location::create([
            'name' => 'مستشفى غزة الطبي',
            'type' => 'medical',
            'latitude' => 31.5120,
            'longitude' => 34.4660,
            'description' => 'يقدم خدمات الطوارئ والإسعاف.',
        ]);

        Location::create([
            'name' => 'ملجأ الشجاعية',
            'type' => 'shelter',
            'latitude' => 31.5200,
            'longitude' => 34.4700,
            'description' => 'ملجأ آمن للسكان أثناء الحروب.',
        ]);
    }
}

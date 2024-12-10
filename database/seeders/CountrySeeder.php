<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'Việt Nam', 'slug' => 'viet-nam', 'image' => 'flags/vietnam.png', 'status' => 'active'],
            ['name' => 'Hoa Kỳ', 'slug' => 'hoa-ky', 'image' => 'flags/usa.png', 'status' => 'active'],
            ['name' => 'Nhật Bản', 'slug' => 'nhat-ban', 'image' => 'flags/japan.png', 'status' => 'active'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}


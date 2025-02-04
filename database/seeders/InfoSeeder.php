<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoSeeder extends Seeder
{
    public function run()
    {
        DB::table('infos')->insert([
            'id' => 1,
            'logo' => 'frontend/img/logo.png',
            'title' => 'VIỆC LÀM TẠI NĂM CHÂU TRÊN THẾ GIỚI',
            'subtitle' => 'JOBS IN FIVE CONTINENTS OF THE WORLD',
            'phone' => 'Số đt/fax: +8467 9957 052',
            'gmail' => 'vietnamvision@gmail.com',
            'copyright' => 'Copyright 2014-2024 Việc Làm Năm Châu',
            'newspaper' => 'Trực thuộc (C) Công Ty Ltd',
            'footer-company' => 'Công Ty TNHH Việc Làm Năm Châu',
            'url_facebook' => 'https://www.facebook.com/vieclamnamchau',
            'url_youtube' => 'https://www.youtube.com/vieclamnamchau',
            'url_partner' => 'https://www.partner.com/vieclamnamchau',
            'number_job_seeker_1' => 0567012132,
            'number_job_seeker_2' => 0567012132,
            'number_employer_1' => 0567012132,
            'number_employer_2' => 0567012132,
        ]);
    }
}

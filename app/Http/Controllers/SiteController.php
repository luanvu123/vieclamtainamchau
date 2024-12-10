<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function countries()
    {
        $countries = collect([
            ['name' => 'Việt Nam', 'flag' => 'frontend/img/flags/vietnam.png'],
            ['name' => 'Hoa Kỳ', 'flag' => 'frontend/img/flags/usa.png'],
            ['name' => 'Nhật Bản', 'flag' => 'frontend/img/flags/japan.png'],
        ]);
        $hotlines = [
            'job_seeker' => [
                'title' => 'Hotline cho người tìm việc',
                'support' => 'Hotline hỗ trợ',
                'number' => '0567 012 132',
                'button_text' => 'Tư vấn cho người tìm việc',
            ],
            'employer' => [
                'title' => 'Hotline cho Nhà tuyển dụng',
                'support' => 'Hotline hỗ trợ kỹ thuật',
                'number' => '0567 012 132',
                'button_text' => 'Tư vấn cho Nhà tuyển dụng',
            ],
        ];
        return view('pages.country', compact('countries', 'hotlines'));
    }
}

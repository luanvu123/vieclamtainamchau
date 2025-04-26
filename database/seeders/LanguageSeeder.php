<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            'Tiếng Anh',
            'Tiếng Việt',
            'Tiếng Pháp',
            'Tiếng Tây Ban Nha',
            'Tiếng Trung Quốc',
            'Tiếng Nhật',
            'Tiếng Hàn Quốc',
            'Tiếng Đức',
            'Tiếng Nga',
            'Tiếng Ý',
            'Tiếng Bồ Đào Nha',
            'Tiếng Ả Rập',
            'Tiếng Thổ Nhĩ Kỳ',
            'Tiếng Hà Lan',
            'Tiếng Ba Lan',
            'Tiếng Hy Lạp',
            'Tiếng Thụy Điển',
            'Tiếng Séc',
            'Tiếng Đan Mạch',
            'Tiếng Phần Lan',
            'Tiếng Na Uy',
            'Tiếng Hungary',
            'Tiếng Romania',
            'Tiếng Bungari',
            'Tiếng Serbia',
            'Tiếng Croatia',
            'Tiếng Slovakia',
            'Tiếng Ukraina',
            'Tiếng Litva',
            'Tiếng Latvia',
            'Tiếng Estonia',
            'Tiếng Do Thái',
            'Tiếng Thái',
            'Tiếng Hindi',
            'Tiếng Indonesia',
            'Tiếng Mã Lai',
            'Tiếng Tagalog',
            'Tiếng Bengal',
            'Tiếng Tamil',
            'Tiếng Punjab',
            'Tiếng Gujarat',
            'Tiếng Marathi',
            'Tiếng Telugu',
            'Tiếng Urdu',
            'Tiếng Nepal',
            'Tiếng Miến Điện',
            'Tiếng Khmer',
            'Tiếng Lào',
            'Tiếng Sinhala',
            'Tiếng Mông Cổ'
        ];

        foreach ($languages as $language) {
            Language::create(['name' => $language]);
        }
    }
}

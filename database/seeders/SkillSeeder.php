<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Kỹ năng giao tiếp',
            'Làm việc nhóm',
            'Tư duy phản biện',
            'Kỹ năng giải quyết vấn đề',
            'Quản lý thời gian',
            'Kỹ năng lãnh đạo',
            'Kỹ năng tổ chức công việc',
            'Kỹ năng đàm phán',
            'Tư duy sáng tạo',
            'Kỹ năng thuyết trình',
            'Sử dụng Excel',
            'Sử dụng Word',
            'Thiết kế PowerPoint',
            'Sử dụng Photoshop',
            'Sử dụng Illustrator',
            'Lập trình PHP',
            'Lập trình JavaScript',
            'Laravel Framework',
            'ReactJS',
            'NodeJS',
            'MySQL',
            'HTML/CSS',
            'SEO cơ bản',
            'Google Ads',
            'Facebook Marketing',
            'Email Marketing',
            'Viết nội dung',
            'Tiếng Anh giao tiếp',
            'Quản lý dự án',
            'Phân tích dữ liệu',
             'Python',
        'Java',
        'C#',
        'C++',
        'Ruby',
        'Go (Golang)',
        'Docker',
        'Kubernetes',
        'AWS (Amazon Web Services)',
        'Azure',
        'Google Cloud Platform',
        'Agile/Scrum',
        'UX/UI Design',
        'Adobe XD',
        'Figma',
        'Canva',
        'Copywriting',
        'Kỹ năng lắng nghe',
        'Kỹ năng thích nghi',
        'Giải quyết xung đột',
        'Tự học',
        'Kỹ năng ra quyết định',
        'Kỹ năng quản lý rủi ro',
        'Sales',
        'Telesales',
        'Customer Service',
        'Phân tích tài chính',
        'Kế toán',
        'Data Visualization',
        'Machine Learning'
        ];

        foreach ($skills as $skillName) {
            Skill::create(['name' => $skillName]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoftSkill;

class SoftSkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'Kỹ năng giao tiếp',
            'Làm việc nhóm',
            'Tư duy phản biện',
            'Kỹ năng giải quyết vấn đề',
            'Lắng nghe tích cực',
            'Tự học',
            'Khả năng thích nghi',
            'Quản lý thời gian',
            'Tư duy sáng tạo',
            'Kỹ năng thuyết trình',
            'Tinh thần trách nhiệm',
            'Khả năng ra quyết định',
            'Quản lý căng thẳng',
            'Kỹ năng đàm phán',
            'Tính kỷ luật',
            'Khả năng lãnh đạo',
            'Tư duy phân tích',
            'Tính kiên nhẫn',
            'Thấu hiểu cảm xúc',
            'Kỹ năng xây dựng mối quan hệ',
            'Kỹ năng quản lý xung đột',
            'Tư duy hướng giải pháp',
            'Chấp nhận phản hồi',
            'Khả năng đồng cảm',
            'Tính chủ động',
            'Khả năng đa nhiệm',
            'Giao tiếp phi ngôn ngữ',
            'Kỹ năng huấn luyện',
            'Khả năng truyền cảm hứng',
            'Tư duy hệ thống',
            'Đọc hiểu cảm xúc người khác',
            'Khả năng lắng nghe phản hồi',
            'Đặt mục tiêu',
            'Tự kiểm soát bản thân',
            'Tư duy chiến lược',
            'Giải quyết mâu thuẫn',
            'Tinh thần cầu tiến',
            'Suy nghĩ tích cực',
            'Tính linh hoạt trong công việc',
            'Kỹ năng viết email chuyên nghiệp',
            'Tổ chức công việc hiệu quả',
            'Quản lý dự án cá nhân',
            'Phối hợp liên phòng ban',
            'Làm việc trong môi trường đa văn hoá',
            'Tư duy phát triển (growth mindset)',
            'Kỹ năng hỏi đúng câu hỏi',
            'Thuyết phục người khác',
            'Thể hiện sự biết ơn',
            'Đồng hành cùng đội nhóm',
            'Kỹ năng học từ thất bại',
        ];

        foreach ($skills as $name) {
            SoftSkill::create(['name' => $name]);
        }
    }
}

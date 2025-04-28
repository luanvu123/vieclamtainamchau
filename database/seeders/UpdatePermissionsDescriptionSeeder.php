<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdatePermissionsDescriptionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            1 => 'Xem danh sách phân quyền',
            2 => 'Tạo mới phân quyền',
            3 => 'Chỉnh sửa phân quyền',
            4 => 'Xóa phân quyền',
            5 => 'Xem danh sách quản trị',
            6 => 'Tạo mới quản trị',
            7 => 'Chỉnh sửa quản trị',
            8 => 'Xóa quản trị',
            9 => 'Xem danh sách dịch vụ',
            10 => 'Tạo mới dịch vụ',
            11 => 'Chỉnh sửa dịch vụ',
            12 => 'Xóa dịch vụ',
            13 => 'Xem danh sách nhà tuyển dụng',
            14 => 'Tạo mới nhà tuyển dụng',
            15 => 'Chỉnh sửa nhà tuyển dụng',
            16 => 'Xóa nhà tuyển dụng',
            17 => 'Xem danh sách ngân hàng',
            18 => 'Tạo mới ngân hàng',
            19 => 'Chỉnh sửa ngân hàng',
            20 => 'Xóa ngân hàng',
            21 => 'Xem danh sách quốc gia',
            22 => 'Tạo mới quốc gia',
            23 => 'Chỉnh sửa quốc gia',
            24 => 'Xóa quốc gia',
            25 => 'Xem danh mục ngành nghề',
            26 => 'Tạo mới danh mục ngành nghề',
            27 => 'Chỉnh sửa danh mục ngành nghề',
            28 => 'Xóa danh mục ngành nghề',
            29 => 'Xem danh mục thể loại',
            30 => 'Tạo mới danh mục thể loại',
            31 => 'Chỉnh sửa danh mục thể loại',
            32 => 'Xóa danh mục thể loại',
            33 => 'Xem danh sách ứng viên',
            34 => 'Tạo mới ứng viên',
            35 => 'Chỉnh sửa ứng viên',
            36 => 'Xóa ứng viên',
            37 => 'Xem danh sách hỗ trợ',
            38 => 'Chỉnh sửa hỗ trợ',
            39 => 'Xóa hỗ trợ',
        ];

        foreach ($permissions as $id => $description) {
            DB::table('permissions')->where('id', $id)->update([
                'description' => $description,
            ]);
        }
    }
}


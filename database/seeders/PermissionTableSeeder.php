<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'service-list',
            'service-create',
            'service-edit',
            'service-delete',
            'employer-list',
            'employer-create',
            'employer-edit',
            'employer-delete',
            'bank-list',
            'bank-create',
            'bank-edit',
            'bank-delete',
            'country-list',
            'country-create',
            'country-edit',
            'country-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'genre-list',
            'genre-create',
            'genre-edit',
            'genre-delete',
            'candidate-list',
            'candidate-create',
            'candidate-edit',
            'candidate-delete',
            'support-list',
            'support-edit',
            'support-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Bàn',
                'description' => 'Các loại bàn nội thất',
                'image' => 'ban.png',
                'categorySlug' => 'ban',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'name' => 'Ghế',
                'description' => 'Các loại ghế nội thất',
                'image' => 'ghe.png',
                'categorySlug' => 'ghe',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'name' => 'Tủ',
                'description' => 'Các loại tủ nội thất',
                'image' => 'tu.png',
                'categorySlug' => 'tu',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'name' => 'Sofa',
                'description' => 'Các loại sofa nội thất',
                'image' => 'sofa.png',
                'categorySlug' => 'sofa',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'name' => 'Đèn',
                'description' => 'Các loại đèn nội thất',
                'image' => 'den.png',
                'categorySlug' => 'den',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'name' => 'Giường',
                'description' => 'Các loại giường nội thất',
                'image' => 'giuong.png',
                'categorySlug' => 'giuong',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'name' => 'Cây',
                'description' => 'Các loại cây trang trí nội thất',
                'image' => 'cay.png',
                'categorySlug' => 'cay',
                'created_at' => now(),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
        ]);
    }
}


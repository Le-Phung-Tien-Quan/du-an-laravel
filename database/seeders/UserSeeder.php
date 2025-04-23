<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Quan',
                'email' => 'quanlptps39861@gmail.com',
                'password' => bcrypt('12345678'), // Mã hóa mật khẩu
                'phone' => '0123456789',
                'address' => 'Ho Chi Minh City, Vietnam',
                'role' => 'customer',
                'created_at' => Carbon::now(),
                'updated_at' => null,
                'deleted_at' => null, // Nếu không xóa người dùng, để là null
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'), // Mã hóa mật khẩu
                'phone' => '0987654321',
                'address' => 'Hanoi, Vietnam',
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => null,
                'deleted_at' => null, // Nếu không xóa người dùng, để là null
            ],
            // Thêm người dùng khác nếu cần
        ]);
    }
}

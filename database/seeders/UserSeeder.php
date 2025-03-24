<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'admin',
            'email' => 'buihieu@gmail.com',
            'password' => bcrypt('123456789'), // Mật khẩu
            'role' => 'admin',
            'address' => 'số 9 Phượng Trì Street',
        ]);
    }
}

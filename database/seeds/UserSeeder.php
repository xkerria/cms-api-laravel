<?php

use App\Model\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nickname' => '张三',
            'phone' => '18111111111',
            'email' => '111@126.com',
            'password' => '111111',
        ]);
    }
}

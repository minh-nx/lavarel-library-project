<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin1 = new User;
        $admin1->id = 2;
        $admin1->firstname = 'Thịnh';
        $admin1->lastname = 'Trương Phúc';
        $admin1->username = 'tinyprojectadmin1';
        $admin1->email = 'phucthinh0013@gmail.com';
        $admin1->password = 'admin123';
        $admin1->email_verified_at = now();

        $admin1->save();
    }
}

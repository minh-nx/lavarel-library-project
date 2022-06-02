<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client1 = new User;
        $client1->id = 15812;
        $client1->firstname = 'Thịnh';
        $client1->lastname = 'Trương Phúc';
        $client1->username = 'truongphucthinh';
        $client1->email = '15812@student.vgu.edu.vn';
        $client1->password = 88888888;
        $client1->email_verified_at = now();
        

        $client2 = new User;
        $client2->id = 15910;
        $client2->firstname = 'Đăng';
        $client2->lastname = 'Trần Phương Hải';
        $client2->username = 'tranphuonghaidang';
        $client2->email = '15910@student.vgu.edu.vn';
        $client2->password = 88888888;
        $client2->email_verified_at = now();

        $client3 = new User;
        $client3->id = 16035;
        $client3->firstname = 'Minh';
        $client3->lastname = 'Võ Khánh';
        $client3->username = 'vokhanhminh';
        $client3->email = '16035@student.vgu.edu.vn';
        $client3->password = 88888888;
        $client3->email_verified_at = now();

        $client1->save();
        $client2->save();
        $client3->save();
        $client1->assignRole('client');
        $client2->assignRole('client');
        $client3->assignRole('client');
    }
}

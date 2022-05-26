<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = new User;
        $superadmin->id = 1;
        $superadmin->firstname = 'Fred';
        $superadmin->lastname = 'Garcia';
        $superadmin->username = 'tinyprojectsuperadmin';
        $superadmin->email = 'victoryroar0013@gmail.com';
        $superadmin->password = 'superadmin123';
        $superadmin->email_verified_at = now();

        $superadmin->save();

        $superadmin->assignRole('super admin');
    }
}

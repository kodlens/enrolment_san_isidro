<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'username' => 'admin',
                'lname' => 'LABAJO',
                'fname' => 'MAYISEL',
                'mname' => 'P',
                'sex' => 'FEMALE',
                //'email' => 'mayesel@dev.com',
                'role' => 'ADMINISTRATOR',
                'password' => Hash::make('aa')
            ],

            [
                'username' => 'ana',
                'lname' => 'TALO',
                'fname' => 'ANA MARIE',
                'mname' => 'P',
                'sex' => 'FEMALE',
                //'email' => 'ana@dev.com',
                'role' => 'REGISTRAR',
                'password' => Hash::make('aa')
            ],

            [
                'username' => 'angele',
                'lname' => 'MUTIA',
                'fname' => 'ANGELE',
                'mname' => 'P',
                'sex' => 'FEMALE',
                //'email' => 'angele@dev.com',
                'role' => 'CASHIER',
                'password' => Hash::make('aa')
            ],



            [
                'username' => 'juan',
                'lname' => 'DELA CRUZ',
                'fname' => 'JUAN',
                'mname' => 'P',
                'sex' => 'FEMALE',
                //'email' => 'angele@dev.com',
                'role' => 'TEACHER',
                'password' => Hash::make('aa')
            ],
            [
                'username' => 'maria',
                'lname' => 'CLARA',
                'fname' => 'MARIA',
                'mname' => 'P',
                'sex' => 'FEMALE',
                //'email' => 'angele@dev.com',
                'role' => 'TEACHER',
                'password' => Hash::make('aa')
            ],
        ];

        \App\Models\User::insertOrIgnore($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
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
                'lname' => 'DELA CRUZ',
                'fname' => 'JUAN',
                'mname' => '',
                'sex' => 'MALE'
            ],
            [
                'lname' => 'SANTOS',
                'fname' => 'LARAH',
                'mname' => '',
                'sex' => 'FEMALE'
            ],

        ];

        \App\Models\Faculty::insertOrIgnore($data);

    }
}

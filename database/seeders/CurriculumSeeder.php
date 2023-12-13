<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
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
                'curriculum_code' => 'ELEM',
                'curriculum_description' => 'ELEMENTARY'
            ],
            [
                'curriculum_code' => 'JHS',
                'curriculum_description' => 'JUNIOR HIGH SCHOOL'
            ], [
                'curriculum_code' => 'SHS',
                'curriculum_description' => 'SENIOR HIGH SCHOOL'
            ],
            
           
        ];

        \App\Models\Curriculum::insertOrIgnore($data);


    }
}

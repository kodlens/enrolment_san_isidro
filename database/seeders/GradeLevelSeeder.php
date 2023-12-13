<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GradeLevelSeeder extends Seeder
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
                'grade_level' => 'GRADE 1',
                'curriculum_code' => 'ELEM',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 2',
                'curriculum_code' => 'ELEM',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 3',
                'curriculum_code' => 'ELEM',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 4',
                'curriculum_code' => 'ELEM',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 5',
                'curriculum_code' => 'ELEM',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 6',
                'curriculum_code' => 'ELEM',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 8',
                'curriculum_code' => 'JHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 9',
                'curriculum_code' => 'JHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 10',
                'curriculum_code' => 'JHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 12',
                'curriculum_code' => 'SHS',
                'active' => 1
            ],
           
        ];

        \App\Models\GradeLevel::insertOrIgnore($data);

    }
}

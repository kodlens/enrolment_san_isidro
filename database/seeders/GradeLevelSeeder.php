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
                'curriculum' => 'PRIMARY',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 2',
                'curriculum' => 'PRIMARY',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 3',
                'curriculum' => 'PRIMARY',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 4',
                'curriculum' => 'PRIMARY',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 5',
                'curriculum' => 'PRIMARY',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 6',
                'curriculum' => 'PRIMARY',
                'active' => 0
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum' => 'JHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 8',
                'curriculum' => 'JHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 9',
                'curriculum' => 'JHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 10',
                'curriculum' => 'JHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum' => 'SHS',
                'active' => 1
            ],
            [
                'grade_level' => 'GRADE 12',
                'curriculum' => 'SHS',
                'active' => 1
            ],
           
        ];

        \App\Models\GradeLevel::insertOrIgnore($data);

    }
}

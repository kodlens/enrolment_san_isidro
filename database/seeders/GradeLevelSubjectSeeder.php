<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GradeLevelSubjectSeeder extends Seeder
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
            //JHS
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 2
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 3
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 4
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 5
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 6
            ],

            //SHS
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 19
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 20
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 21
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 22
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 23
            ],
           
        ];

        \App\Models\GradeLevelSubject::insertOrIgnore($data);
    }
}

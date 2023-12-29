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
                'subject_id' => 2,
                'semester_id' => 0
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 3,
                'semester_id' => 0
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 4,
                'semester_id' => 0
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 5,
                'semester_id' => 0
            ],
            [
                'grade_level' => 'GRADE 7',
                'curriculum_code' => 'JHS',
                'subject_id' => 6,
                'semester_id' => 0
            ],

            //SHS
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 19,
                'semester_id' => 1
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 20,
                'semester_id' => 1
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 21,
                'semester_id' => 1
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 22,
                'semester_id' => 2
            ],
            [
                'grade_level' => 'GRADE 11',
                'curriculum_code' => 'SHS',
                'subject_id' => 23,
                'semester_id' => 2
            ],
           
        ];

        \App\Models\GradeLevelSubject::insertOrIgnore($data);
    }
}

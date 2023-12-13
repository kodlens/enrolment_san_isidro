<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionSubjectSeeder extends Seeder
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
                'grade_level' => 'GRADE 10',
                'section_id' => 10,
                'subject_id' => 26,

            ],
            [
                'grade_level' => 'GRADE 10',
                'section_id' => 10,
                'subject_id' => 27,

            ],
            [
                'grade_level' => 'GRADE 10',
                'section_id' => 10,
                'subject_id' => 28,

            ],
            [
                'grade_level' => 'GRADE 10',
                'section_id' => 10,
                'subject_id' => 2,

            ],



            [
                'grade_level' => 'GRADE 10',
                'section_id' => 11,
                'subject_id' => 3,

            ],
            [
                'grade_level' => 'GRADE 10',
                'section_id' => 11,
                'subject_id' => 4,

            ],
            [
                'grade_level' => 'GRADE 10',
                'section_id' => 11,
                'subject_id' => 5,
            ],
            [
                'grade_level' => 'GRADE 10',
                'section_id' => 11,
                'subject_id' => 6,
            ],
        ];

        \App\Models\SectionSubject::insertOrIgnore($data);
    }
}

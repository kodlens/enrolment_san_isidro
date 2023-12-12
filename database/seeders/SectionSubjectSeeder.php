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
                'academic_year_id' => 5,
                'grade_level' => 'GRADE 10',
                'section_id' => 10,
                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'subject_id' => 26,

            ],
            [
                'academic_year_id' => 5,
                'grade_level' => 'GRADE 10',
                'section_id' => 10,
                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'subject_id' => 27,

            ],
            [
                'academic_year_id' => 5,
                'grade_level' => 'GRADE 10',
                'section_id' => 10,
                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'subject_id' => 28,

            ],
            [
                'academic_year_id' => 5,
                'grade_level' => 'GRADE 10',
                'section_id' => 10,
                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'subject_id' => 2,

            ],



            [
                'academic_year_id' => 5,
                'grade_level' => 'GRADE 10',
                'section_id' => 9,
                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'subject_id' => 3,

            ],
            [
                'academic_year_id' => 5,
                'grade_level' => 'GRADE 10',
                'section_id' => 9,
                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'subject_id' => 4,

            ],
            [
                'academic_year_id' => 5,
                'grade_level' => 'GRADE 10',
                'section_id' => 9,
                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'subject_id' => 5,

            ],
            [
                'academic_year_id' => 5,
                'grade_level' => 'GRADE 10',
                'section_id' => 9,
                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'subject_id' => 6,

            ],
        ];

        \App\Models\SectionSubject::insertOrIgnore($data);
    }
}

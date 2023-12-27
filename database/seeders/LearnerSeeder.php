<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LearnerSeeder extends Seeder
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
                'academic_year_id' => 1,
                'student_id' => '2023-000001',
                'grade_level' => 'GRADE 11',
                'learner_status' => 'NEW',
                'lrn' => '20221123231',
                'school_id' => null,
                'lname' => 'LABAJO',
                'fname' => 'MAYESEL',
                'mname' => '',
                'extension' => '',
                'sex' => 'FEMALE',
                'birthdate' => '2000-01-20',
                'birthplace' => 'TUDELA, MISAMIS OCCIDENTAL',
                'age' => '22',
                'last_school_attended' => 'TCNHS',
                'province' => '1602',
                'city' => '160203',
                'barangay' => '160203010',
                'street' => '',
                'zipcode' => null,
                'contact_no' => '09161231234',
                'religion' => 'ROMAN CATHOLIC',

                'father_lname' => 'LABAJO',
                'father_fname' => 'JOHN',
                'father_mname' => '',
                'father_extension' => '',
                'father_contact_no' => '09161231234',
                'father_religion' => 'ROMAN CATHOLIC',
                'father_education' => 'BSBA',

                'mother_maiden_lname' => 'MAIDEN LABAJO',
                'mother_maiden_fname' => 'JANE',
                'mother_maiden_mname' => '',
                'mother_maiden_contact_no' => '09161231235',
                'mother_religion' => 'ROMAN CATHOLIC',
                'mother_education' => 'BSBA',

                'guardian_lname' => 'DELA CRUZ',
                'guardian_fname' => 'JUAN',
                'guardian_mname' => '',
                'guardian_extension' => '',
                'guardian_contact_no' => '09164568522',

                'semester_id' => 1,
                'track_id' => 1,
                'strand_id' => 4,
                'administer_by' => 'ADMIN',
            ],



            [
                'academic_year_id' => 1,
                'student_id' => '2023-000002',
                'grade_level' => 'GRADE 7',
                'learner_status' => 'NEW',
                'lrn' => '2023112233',
                'school_id' => null,
                'lname' => 'Mutia',
                'fname' => 'Angelie ',
                'mname' => 'Caro',
                'extension' => '',
                'sex' => 'FEMALE',
                'birthdate' => '2000-01-20',
                'birthplace' => 'TUDELA, MISAMIS OCCIDENTAL',
                'age' => '22',
                'last_school_attended' => 'TCNHS',
                'province' => '1602',
                'city' => '160203',
                'barangay' => '160203010',
                'street' => '',
                'zipcode' => null,
                'contact_no' => '09161231234',
                'religion' => 'ROMAN CATHOLIC',

                'father_lname' => 'LABAJO',
                'father_fname' => 'JOHN',
                'father_mname' => '',
                'father_extension' => '',
                'father_contact_no' => '09161231234',
                'father_religion' => 'ROMAN CATHOLIC',
                'father_education' => 'BSBA',

                'mother_maiden_lname' => 'MAIDEN LABAJO',
                'mother_maiden_fname' => 'JANE',
                'mother_maiden_mname' => '',
                'mother_maiden_contact_no' => '09161231235',
                'mother_religion' => 'ROMAN CATHOLIC',
                'mother_education' => 'BSBA',

                'guardian_lname' => 'DELA CRUZ',
                'guardian_fname' => 'JUAN',
                'guardian_mname' => '',
                'guardian_extension' => '',
                'guardian_contact_no' => '09164568522',

                'semester_id' => 0,
                'track_id' => 0,
                'strand_id' => 0,
                'administer_by' => 'ADMIN',
            ],


            [
                'academic_year_id' => 1,
                'student_id' => '2023-000003',
                'grade_level' => 'GRADE 12',
                'learner_status' => 'NEW',
                'lrn' => '2023112233',
                'school_id' => null,
                'lname' => 'Eharez',
                'fname' => 'Viperlyn',
                'mname' => '',
                'extension' => '',
                'sex' => 'FEMALE',
                'birthdate' => '2000-01-20',
                'birthplace' => 'TUDELA, MISAMIS OCCIDENTAL',
                'age' => '22',
                'last_school_attended' => 'TCNHS',
                'province' => '1042',
                'city' => '104205',
                'barangay' => '104205013',
                'street' => '',
                'zipcode' => null,
                'contact_no' => '09161231234',
                'religion' => 'ROMAN CATHOLIC',

                'father_lname' => 'LABAJO',
                'father_fname' => 'JOHN',
                'father_mname' => '',
                'father_extension' => '',
                'father_contact_no' => '09161231234',
                'father_religion' => 'ROMAN CATHOLIC',
                'father_education' => 'BSBA',

                'mother_maiden_lname' => 'MAIDEN LABAJO',
                'mother_maiden_fname' => 'JANE',
                'mother_maiden_mname' => '',
                'mother_maiden_contact_no' => '09161231235',
                'mother_religion' => 'ROMAN CATHOLIC',
                'mother_education' => 'BSBA',

                'guardian_lname' => 'DELA CRUZ',
                'guardian_fname' => 'JUAN',
                'guardian_mname' => '',
                'guardian_extension' => '',
                'guardian_contact_no' => '09164568522',

                'semester_id' => 1,
                'track_id' => 2,
                'strand_id' => 6,

                'administer_by' => 'ADMIN',
            ],
            
           
        ];

        \App\Models\Learner::insertOrIgnore($data);
    }
}

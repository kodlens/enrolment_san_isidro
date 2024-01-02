<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
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
                'academic_year_code' => '23-24',
                'academic_year_desc' => 'ACADEMIC YEAR 2023-2024',
                'is_active' => 1
            ],
            [
                'academic_year_code' => '22-23',
                'academic_year_desc' => 'ACADEMIC YEAR 2022-2023',
                'is_active' => 0
            ]

        ];

        \App\Models\AcademicYear::insertOrIgnore($data);
    }
}

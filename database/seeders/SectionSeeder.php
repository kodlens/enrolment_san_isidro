<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
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
                'grade_level' => 'GRADE 7',
                'max' => 45,
                'section' => 'CHARITY'
            ],[
                'grade_level' => 'GRADE 7',
                'max' => 45,
                'section' => 'COURAGE'
            ],[
                
                'grade_level' => 'GRADE 7',
                'max' => 45,
                'section' => 'COURTESY'
            ],[
               
                'grade_level' => 'GRADE 8',
                'max' => 45,
                'section' => 'FAITH'
            ],[
                
                'grade_level' => 'GRADE 8',
                'max' => 45,
                'section' => 'ALS'
            ],[
                
                'grade_level' => 'GRADE 8',
                'max' => 45,
                'section' => 'OHSP'
            ],[
               
                'grade_level' => 'GRADE 9',
                'max' => 45,
                'section' => 'LOYALTY'
            ],[
                
                'grade_level' => 'GRADE 9',
                'max' => 45,
                'section' => 'STEM 1'
            ],[
                
                'grade_level' => 'GRADE 9',
                'max' => 45,
                'section' => 'HONESTY'
            ],[
               
                'grade_level' => 'GRADE 10',
                'max' => 45,
                'section' => 'HUMILITY'
            ],[
                
                'grade_level' => 'GRADE 10',
                'max' => 45,
                'section' => 'INTEGRITY'
            ],[
                
                'grade_level' => 'GRADE 10',
                'max' => 45,
                'section' => 'PERSEVERANCE'
            ],[
                
                'grade_level' => 'GRADE 10',
                'max' => 45,
                'section' => 'OBEDIENCE'
            ],[
               
                'grade_level' => 'GRADE 10',
                'max' => 45,
                'section' => 'PATIENCE'
            ],[
                
                'grade_level' => 'GRADE 11',
                'max' => 45,
                'section' => 'SIMPLICITY'
            ],[
               
                'grade_level' => 'GRADE 11',
                'max' => 45,
                'section' => 'SINCERITY'
            ],[
                
                'grade_level' => 'GRADE 11',
                'max' => 45,
                'section' => 'AMETHYST'
            ],[
                
                'grade_level' => 'GRADE 11',
                'max' => 45,
                'section' => 'RHODONITE'
            ],[
                
                'grade_level' => 'GRADE 11',
                'max' => 45,
                'section' => 'GARNET'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'OHSP - GRADE 12'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'PEARL'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'JADE'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'ONYX'
            ],[
               
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'OPAL'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'AMBER'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'RUBY'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'SAPPHIRE'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'TOPAZ'
            ],[
                
                'grade_level' => 'GRADE 12',
                'max' => 45,
                'section' => 'QUARTZ'
            ],

        ];

        \App\Models\Section::insertOrIgnore($data);
    }
}

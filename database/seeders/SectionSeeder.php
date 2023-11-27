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
               
                'max' => 45,
                'section' => 'CHARITY'
            ],
            [
               
                'max' => 45,
                'section' => 'COURAGE'
            ],
            [
                
                'max' => 45,
                'section' => 'COURTESY'
            ],[
               
                'max' => 45,
                'section' => 'FAITH'
            ],[
                
                'max' => 45,
                'section' => 'ALS'
            ],[
                
                'max' => 45,
                'section' => 'OHSP'
            ],[
               
                'max' => 45,
                'section' => 'LOYALTY'
            ],[
                
                'max' => 45,
                'section' => 'STEM 1'
            ],[
                
                'max' => 45,
                'section' => 'HONESTY'
            ],[
               
                'max' => 45,
                'section' => 'HUMILITY'
            ],[
                
                'max' => 45,
                'section' => 'INTEGRITY'
            ],[
                
                'max' => 45,
                'section' => 'PERSEVERANCE'
            ],[
                
                'max' => 45,
                'section' => 'OBEDIENCE'
            ],[
               
                'max' => 45,
                'section' => 'PATIENCE'
            ],[
                
                'max' => 45,
                'section' => 'SIMPLICITY'
            ],[
               
                'max' => 45,
                'section' => 'SINCERITY'
            ],[
                
                'max' => 45,
                'section' => 'AMETHYST'
            ],[
                
                'max' => 45,
                'section' => 'RHODONITE'
            ],[
                
                'max' => 45,
                'section' => 'GARNET'
            ],[
                
                'max' => 45,
                'section' => 'OHSP - GRADE 12'
            ],[
                
                'max' => 45,
                'section' => 'PEARL'
            ],[
                
                'max' => 45,
                'section' => 'JADE'
            ],[
                
                'max' => 45,
                'section' => 'ONYX'
            ],[
               
                'max' => 45,
                'section' => 'OPAL'
            ],[
                
                'max' => 45,
                'section' => 'AMBER'
            ],[
                
                'max' => 45,
                'section' => 'RUBY'
            ],[
                
                'max' => 45,
                'section' => 'SAPPHIRE'
            ],[
                
                'max' => 45,
                'section' => 'TOPAZ'
            ],[
                
                'max' => 45,
                'section' => 'QUARTZ'
            ],

        ];

        \App\Models\Section::insertOrIgnore($data);
    }
}

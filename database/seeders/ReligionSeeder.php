<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
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
                'religion' => 'ROMAN CATHOLIC',
            ],
            [
                'religion' => '7TH DAY ADVENTIST',
            ],
            
           
        ];

        \App\Models\Religion::insertOrIgnore($data);

    }
}

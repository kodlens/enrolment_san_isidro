<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OtherFeeSeeder extends Seeder
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
                'description' => 'INTERNET',
                'amount' => 100
            ],
            [
                'description' => 'LIBRARY',
                'amount' => 100
            ],
            [
                'description' => 'PUBLICATION',
                'amount' => 150

            ],
           
        ];

        \App\Models\OtherFee::insertOrIgnore($data);


    }
}

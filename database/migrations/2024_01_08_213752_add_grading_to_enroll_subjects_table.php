<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGradingToEnrollSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enroll_subjects', function (Blueprint $table) {
            //
            $table->double('first_grading')->nullable()->default(0);
            $table->double('second_grading')->nullable()->default(0);
            $table->double('third_grading')->nullable()->default(0);
            $table->double('fourth_grading')->nullable()->default(0);
            $table->double('final_grade')->nullable()->default(0);
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enroll_subjects', function (Blueprint $table) {
            //
        });
    }
}

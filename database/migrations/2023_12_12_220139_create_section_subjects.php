<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_subjects', function (Blueprint $table) {
            $table->id('section_subject_id');

            // $table->unsignedBigInteger('academic_year_id');
            // $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('grade_level', 20)->nullable();
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('section_id')->on('sections')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_subjects');
    }
}

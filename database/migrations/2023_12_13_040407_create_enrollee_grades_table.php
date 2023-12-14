<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolleeGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollee_grades', function (Blueprint $table) {
            $table->id('enrollee_grade_id');

            // $table->unsignedBigInteger('academic_year_id');
            // $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('enroll_id');
            $table->foreign('enroll_id')->references('enroll_id')->on('enrolls')
                ->onUpdate('cascade')->onDelete('cascade');
            
            // $table->string('grade_level', 20)->nullable();

            // $table->unsignedBigInteger('learner_id');
            // $table->foreign('learner_id')->references('learner_id')->on('learners')
            //     ->onUpdate('cascade')->onDelete('cascade');

            // $table->unsignedBigInteger('section_id');
            // $table->foreign('section_id')->references('section_id')->on('enrolls')
            //     ->onUpdate('cascade')->onDelete('cascade');

            // $table->unsignedBigInteger('semester_id')->default(0);
            // $table->unsignedBigInteger('track_id')->default(0);
            // $table->unsignedBigInteger('strand_id')->default(0);

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->double('grade')->default(0)
                ->nullable();

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
        Schema::dropIfExists('enrollee_grades');
    }
}

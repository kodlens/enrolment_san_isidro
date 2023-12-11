<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearnerGradeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learner_grade_details', function (Blueprint $table) {
            $table->id('learner_grade_detail_id');

            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('learner_grade_id');
            $table->foreign('learner_grade_id')->references('learner_grade_id')->on('learner_grades')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('learner_id');
            $table->foreign('learner_id')->references('learner_id')->on('learners')
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
        Schema::dropIfExists('learner_grade_details');
    }
}

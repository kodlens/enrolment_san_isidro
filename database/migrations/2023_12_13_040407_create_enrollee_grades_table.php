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

            $table->unsignedBigInteger('enroll_id');
            $table->foreign('enroll_id')->references('enroll_id')->on('enrolls')
                ->onUpdate('cascade')->onDelete('cascade');
            

            $table->unsignedBigInteger('learner_id');
            $table->foreign('learner_id')->references('learner_id')->on('enrolls')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('section_id')->on('enrolls')
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeLevelSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_level_subjects', function (Blueprint $table) {
            $table->id('grade_level_subject_id');
            $table->string('grade_level', 20)->nullable();
            $table->string('curriculum_code', 20)->nullable();

            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('semester_id')->nullable()
                ->default(0);

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
        Schema::dropIfExists('grade_level_subjects');
    }
}

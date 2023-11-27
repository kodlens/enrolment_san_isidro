<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_subjects', function (Blueprint $table) {
            $table->id('enroll_subject_id');

            $table->unsignedBigInteger('enroll_id');
            $table->foreign('enroll_id')->references('enroll_id')->on('enrolls')
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
        Schema::dropIfExists('enroll_subjects');
    }
}

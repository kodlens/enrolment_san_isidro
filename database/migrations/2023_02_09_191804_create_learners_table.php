<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learners', function (Blueprint $table) {
            $table->id('learner_id');

            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('grade_level')->nullable();
            $table->tinyInteger('learner_status')->nullable(0);

            //$table->string('psa_cert')->nullable();
            $table->string('lrn', 30)->nullable();
            $table->string('school_id',30)->nullable();
            $table->string('lname', 50)->nullable();
            $table->string('fname', 50)->nullable();
            $table->string('mname', 50)->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('sex', 10)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace', 100)->nullable();
            $table->string('age', 3)->nullable();
            $table->string('last_school_attended')->nullable();
      
            $table->string('current_country')->nullable();
            $table->string('current_province')->nullable();
            $table->string('current_city')->nullable();
            $table->string('current_barangay')->nullable();
            $table->string('current_street')->nullable();
            $table->string('current_zipcode')->nullable();

            //$table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('religion')->nullable();

            //father
            $table->string('father_lname')->nullable();
            $table->string('father_fname')->nullable();
            $table->string('father_mname')->nullable();
            $table->string('father_extension')->nullable();
            $table->string('father_contact_no')->nullable();
            $table->string('father_religion')->nullable();
            $table->string('father_education')->nullable();

            //mother
            $table->string('mother_maiden_lname')->nullable();
            $table->string('mother_maiden_fname')->nullable();
            $table->string('mother_maiden_mname')->nullable();
            $table->string('mother_maiden_contact_no')->nullable();
            $table->string('mother_religion')->nullable();
            $table->string('mother_education')->nullable();


            $table->string('guardian_lname')->nullable();
            $table->string('guardian_fname')->nullable();
            $table->string('guardian_mname')->nullable();
            $table->string('guardian_extension')->nullable();
            $table->string('guardian_contact_no')->nullable();


            $table->unsignedBigInteger('semester_id')->default(0);
            $table->string('senior_high_school_id', 30)->nullable();

            $table->unsignedBigInteger('track_id')->default(0);
            $table->unsignedBigInteger('strand_id')->default(0);

            $table->string('administer_by')->nullable();

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
        Schema::dropIfExists('learners');
    }
}

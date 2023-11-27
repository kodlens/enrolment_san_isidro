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

            $table->string('student_id', 10)->nullable();
            $table->string('grade_level', 15)->nullable();
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
            $table->string('contact_no', 50)->nullable();
            $table->string('religion', 50)->nullable();

            //father
            $table->string('father_lname', 50)->nullable();
            $table->string('father_fname', 50)->nullable();
            $table->string('father_mname', 50)->nullable();
            $table->string('father_extension', 50)->nullable();
            $table->string('father_contact_no', 50)->nullable();
            $table->string('father_religion', 50)->nullable();
            $table->string('father_education', 50)->nullable();

            //mother
            $table->string('mother_maiden_lname', 50)->nullable();
            $table->string('mother_maiden_fname', 50)->nullable();
            $table->string('mother_maiden_mname', 50)->nullable();
            $table->string('mother_maiden_contact_no', 50)->nullable();
            $table->string('mother_religion', 50)->nullable();
            $table->string('mother_education', 50)->nullable();


            $table->string('guardian_lname', 50)->nullable();
            $table->string('guardian_fname', 50)->nullable();
            $table->string('guardian_mname', 50)->nullable();
            $table->string('guardian_extension', 50)->nullable();
            $table->string('guardian_contact_no', 50)->nullable();


            $table->unsignedBigInteger('semester_id')->default(0);
            $table->string('senior_high_school_id', 30)->nullable();

            $table->unsignedBigInteger('track_id')->default(0);
            $table->unsignedBigInteger('strand_id')->default(0);

            $table->string('administer_by', 30)->nullable();

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

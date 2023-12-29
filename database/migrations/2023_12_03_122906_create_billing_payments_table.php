<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_payments', function (Blueprint $table) {

            $table->id('billing_payment_id');
            
            $table->unsignedBigInteger('billing_id');
            $table->foreign('billing_id')->references('billing_id')->on('billings')
                ->onUpdate('cascade')->onDelete('cascade');
            

            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years')
                ->onUpdate('cascade')->onDelete('cascade');  

            $table->unsignedBigInteger('enroll_id');
            $table->foreign('enroll_id')->references('enroll_id')->on('enrolls')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('learner_id');
            $table->foreign('learner_id')->references('learner_id')->on('learners')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->date('date_paid')->nullable();
            $table->double('current_balance')->default(0);
            $table->double('payment')->default(0);
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('billing_payments');
    }
}

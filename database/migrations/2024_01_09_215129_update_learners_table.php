<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLearnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learners', function (Blueprint $table) {
            //
            
            $table->string('mother_tongue')->nullable()
                ->after('religion');
            $table->string('ip')->nullable()
                ->after('mother_tongue');

            $table->string('guardian_relationship')->nullable()
                ->after('guardian_contact_no');
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('learners', function (Blueprint $table) {
            //
        });
    }
}

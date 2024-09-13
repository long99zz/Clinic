<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prescription_id')->length('10');
            $table->integer('medicine_id')->length('10');
            $table->integer('quantity');
            $table->string('description')->length('200');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        
        });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}

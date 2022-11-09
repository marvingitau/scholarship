<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplinarySectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('displinary_sections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiary_id');
            $table->bigInteger('user_id');
            $table->string('subject')->nullable();
            $table->date('date')->nullable();
            $table->mediumText('recommendation')->nullable();
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
        Schema::dropIfExists('displinary_sections');
    }
}

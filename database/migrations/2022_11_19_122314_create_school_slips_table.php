<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolSlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_slips', function (Blueprint $table) {
            $table->id();
            $table->integer('schoolreportheader_id');
            $table->bigInteger('beneficiary_id')->nullable();
            $table->string('name')->nullable();
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('school_slips');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_sections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiary_id');
            $table->bigInteger('user_id');
            $table->integer('fees_id');
            $table->string('year');
            $table->integer('yearlyfee');
            $table->string('term1')->nullable();
            $table->string('term2')->nullable();
            $table->string('term3')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('fee_sections');
    }
}

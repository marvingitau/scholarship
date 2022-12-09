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
            $table->integer('term1')->dafault(0);
            $table->integer('term2')->dafault(0);
            $table->integer('term3')->dafault(0);
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

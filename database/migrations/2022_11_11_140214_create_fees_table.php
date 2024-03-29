<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiary_id');
            $table->string('beneficiary');
            $table->integer('yearlyfee')->default(0);
            $table->integer('AllocatedYealyFee')->default(0);
            $table->integer('yearlyfeebal')->default(0);
            $table->integer('year')->nullable();
            $table->string('school')->nullable();
            $table->integer('expectedterm1')->nullable();//School expected value
            $table->integer('expectedterm2')->nullable();
            $table->integer('expectedterm3')->nullable();
            $table->tinyInteger('status')->default(1);// indicates if this fee is the current one.
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
        Schema::dropIfExists('fees');
    }
}

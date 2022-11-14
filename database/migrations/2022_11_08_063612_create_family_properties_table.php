<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_properties', function (Blueprint $table) {
            $table->id();
            // Family Property
            $table->bigInteger('beneficiary_id');
            $table->string('Type1')->nullable();
            $table->string('Size1')->nullable();
            $table->string('Location1')->nullable();

            // $table->string('Type2')->nullable();
            // $table->string('Size2')->nullable();
            // $table->string('Location2')->nullable();

            // $table->string('Type3')->nullable();
            // $table->string('Size3')->nullable();
            // $table->string('Location3')->nullable();

            // $table->string('Type4')->nullable();
            // $table->string('Size4')->nullable();
            // $table->string('Location4')->nullable();

            // $table->string('Type5')->nullable();
            // $table->string('Size5')->nullable();
            // $table->string('Location5')->nullable();

            // $table->string('Type6')->nullable();
            // $table->string('Size6')->nullable();
            // $table->string('Location6')->nullable();
            
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
        Schema::dropIfExists('family_properties');
    }
}

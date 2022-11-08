<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_details', function (Blueprint $table) {
            $table->id();
            // Family Details
            $table->bigInteger('beneficiary_id');
            $table->string('Father')->nullable();
            $table->string('Mother')->nullable();
            $table->string('FatherAlive')->nullable();
            $table->string('MotherAlive')->nullable();
            $table->string('FatherAge')->nullable();
            $table->string('MotherAge')->nullable();
            $table->string('FatherID')->nullable();
            $table->string('MotherID')->nullable();
            $table->string('FatherOccupation')->nullable();
            $table->string('MotherOccupation')->nullable();
            $table->string('FatherOtherSourceIncome')->nullable();
            $table->string('MotherOtherSourceIncome')->nullable();
            $table->string('FatherMobile')->nullable();
            $table->string('MotherMobile')->nullable();
            $table->string('FatherTelephone')->nullable();
            $table->string('MotherTelephone')->nullable();
            $table->string('FatherEmail')->nullable();
            $table->string('MotherEmail')->nullable();
            $table->string('ActivePhoneNumber');
            $table->string('LiveWithName')->nullable();
            $table->string('LiveWitRelation')->nullable();

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
        Schema::dropIfExists('family_details');
    }
}

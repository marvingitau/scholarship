<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiaryformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaryforms', function (Blueprint $table) {
            $table->id();
            // Personal Information
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('gender')->default('MALE');
            $table->string('age')->nullable();
            $table->date('DOB')->nullable();
            $table->string('KCPEIndex')->nullable();
            $table->string('SecondaryAdmitted')->nullable();
            $table->string('CurrentForm')->nullable();
            $table->string('FormJoining')->nullable();
            $table->string('CurrentAddress')->nullable();
            $table->string('PoBox')->nullable();
            $table->string('PostalCode')->nullable();
            $table->string('CityTown')->nullable();
            $table->string('County')->nullable();
            $table->string('TelephoneGuardian')->nullable();
            $table->string('EmailGuardian')->nullable();
            $table->string('AnotherSponship')->default('NO');
            $table->string('AnotherSponshipRemark')->nullable();
            $table->string('ClerkStatus')->default('OPEN');//CLOSED-> when clerk achives
            $table->string('AdminStatus')->default('PENDING');//APPROVED,DECLINED
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
        Schema::dropIfExists('beneficiaryforms');
    }
}

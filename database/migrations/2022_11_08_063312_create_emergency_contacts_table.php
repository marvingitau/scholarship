<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
                // Emergency Contact
                $table->bigInteger('beneficiary_id');
                $table->string('EmergencyName')->nullable();
                $table->string('EmergencyRelationship')->nullable();
                $table->string('EmergencyPhysicalAddress')->nullable();
                $table->string('EmergencyPoBox')->nullable();
                $table->string('EmergencyTelephone')->nullable();
                $table->string('EmergencyMobile')->nullable();
                $table->string('EmergencyEmail')->nullable();

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
        Schema::dropIfExists('emergency_contacts');
    }
}

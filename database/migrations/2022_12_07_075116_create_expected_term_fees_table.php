<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpectedTermFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expected_term_fees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiary_id');
            $table->integer('year')->nullable();
            $table->float('TermOneFee')->nullable();
            $table->float('TermTwoFee')->nullable();
            $table->float('TermThreeFee')->nullable();
            $table->string('AllocatedYealyFee')->nullable();
            $table->string('beneficiary')->nullable();
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
        Schema::dropIfExists('expected_term_fees');
    }
}

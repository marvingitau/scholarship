<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeePaymentEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_payment_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiary_id');
            $table->integer('year')->nullable();
            $table->string('term')->nullable();
            $table->string('amount')->nullable();
            $table->string('creator')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('fee_payment_entries');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiblingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siblings', function (Blueprint $table) {
            $table->id();
            // Sibling 
            $table->bigInteger('beneficiary_id');
            
            $table->string('SiblingName1')->nullable();
            $table->string('SiblingRelation1')->nullable();
            $table->string('SiblingAge1')->nullable();
            $table->string('SiblingOccupation1')->nullable();
            $table->string('SiblingMobile1')->nullable();

            // $table->string('SiblingName2')->nullable();
            // $table->string('SiblingRelation2')->nullable();
            // $table->string('SiblingAge2')->nullable();
            // $table->string('SiblingOccupation2')->nullable();
            // $table->string('SiblingMobile2')->nullable();

            // $table->string('SiblingName3')->nullable();
            // $table->string('SiblingRelation3')->nullable();
            // $table->string('SiblingAge3')->nullable();
            // $table->string('SiblingOccupation3')->nullable();
            // $table->string('SiblingMobile3')->nullable();

            // $table->string('SiblingName4')->nullable();
            // $table->string('SiblingRelation4')->nullable();
            // $table->string('SiblingAge4')->nullable();
            // $table->string('SiblingOccupation4')->nullable();
            // $table->string('SiblingMobile4')->nullable();

            // $table->string('SiblingName5')->nullable();
            // $table->string('SiblingRelation5')->nullable();
            // $table->string('SiblingAge5')->nullable();
            // $table->string('SiblingOccupation5')->nullable();
            // $table->string('SiblingMobile5')->nullable();

            // $table->string('SiblingName6')->nullable();
            // $table->string('SiblingRelation6')->nullable();
            // $table->string('SiblingAge6')->nullable();
            // $table->string('SiblingOccupation6')->nullable();
            // $table->string('SiblingMobile6')->nullable();

            // $table->string('SiblingName7')->nullable();
            // $table->string('SiblingRelation7')->nullable();
            // $table->string('SiblingAge7')->nullable();
            // $table->string('SiblingOccupation7')->nullable();
            // $table->string('SiblingMobile7')->nullable();

            // $table->string('SiblingName8')->nullable();
            // $table->string('SiblingRelation8')->nullable();
            // $table->string('SiblingAge8')->nullable();
            // $table->string('SiblingOccupation8')->nullable();
            // $table->string('SiblingMobile8')->nullable();

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
        Schema::dropIfExists('siblings');
    }
}

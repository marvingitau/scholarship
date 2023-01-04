<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportingDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporting_docs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_unique')->nullable();
            $table->string('file_path')->nullable();
            $table->string('beneficiary_id')->nullable();
            $table->string('type')->nullable();//FORM,PASSPORT,FEES
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
        Schema::dropIfExists('supporting_docs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_infos', function (Blueprint $table) {
            $table->id();
            // Academic Information
            $table->bigInteger('beneficiary_id');
            $table->string('Subject1')->nullable();
            $table->integer('Marks1')->default(0);
            $table->string('Subject2')->nullable();
            $table->integer('Marks2')->default(0);
            $table->string('Subject3')->nullable();
            $table->integer('Marks3')->default(0);
            $table->string('Subject4')->nullable();
            $table->integer('Marks4')->default(0);
            $table->string('Subject5')->nullable();
            $table->integer('Marks5')->default(0);
            $table->string('Subject6')->nullable();
            $table->integer('Marks6')->default(0);
            $table->string('Subject7')->nullable();
            $table->integer('Marks7')->default(0);
            $table->string('Subject8')->nullable();
            $table->integer('Marks8')->default(0);
            $table->string('Subject9')->nullable();
            $table->integer('Marks9')->default(0);
            $table->string('Subject10')->nullable();
            $table->integer('Marks10')->default(0);
            $table->string('TotalMarks')->nullable();

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
        Schema::dropIfExists('academic_infos');
    }
}

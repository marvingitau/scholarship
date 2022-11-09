<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorshipSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentorship_sections', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficiary_id');
            $table->bigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->mediumText('remark')->nullable();
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
        Schema::dropIfExists('mentorship_sections');
    }
}

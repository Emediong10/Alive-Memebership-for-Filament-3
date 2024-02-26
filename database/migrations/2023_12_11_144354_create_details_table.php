<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->string('course_of_study')->nullable();
            $table->string('degree')->nullable();
            $table->string('occupation')->nullable();
            $table->string('professional_abilities')->nullable();
            $table->string('past_mission')->nullable();
            $table->string('area_of_interest')->nullable();
            $table->string('spiritual_gift')->nullable();
            $table->string('skills')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->BigInteger('approver_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
};

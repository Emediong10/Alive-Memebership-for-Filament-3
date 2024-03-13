<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->BigInteger('spiritual_gift_id')->unsigned()->nullable()->change();
            $table->BigInteger('area_interest_id')->unsigned()->nullable()->change();
            $table->BigInteger('mission_id')->unsigned()->nullable()->change();
            $table->BigInteger('skill_id')->unsigned()->nullable()->change();

            $table->foreign('spiritual_gift_id')->references('id')->on('spiritual_gifts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('area_interest_id')->references('id')->on('area_interests')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

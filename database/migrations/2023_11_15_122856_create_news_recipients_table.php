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
        Schema::create('news_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained('news')->nullable()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_group')->default(true);
            $table->foreignId('member_types_id')->constrained('member_types')->nullable()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->nullable()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('news_recipients');
    }
};

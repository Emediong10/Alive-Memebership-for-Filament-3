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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_type_id')->constrained('event_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('venue')->nullable();
            $table->boolean('is_paid_event')->default(false);
            $table->string('event_fees')->nullable();
            $table->string('event_fees_currency')->nullable();
            $table->tinyText('description')->nullable();
            $table->string('event_flyer');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

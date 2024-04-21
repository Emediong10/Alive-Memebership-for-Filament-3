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
        Schema::create('event_applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('transaction_reference')->unique()->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('payment_method')->nullable();
            $table->smallInteger('approval_status');
            $table->boolean('confirm_attendance');
            $table->boolean('attendance_confirmed');
            $table->tinyText('comments');
            $table->tinyText('payment_evidence')->nullable();
            $table->tinyText('supplementary_payments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_applicants');
    }
};

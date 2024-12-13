<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\NewsRecipient;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Parallax\FilamentComments\Models\FilamentComment::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(NewsRecipient::class);
            $table->longtext('reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_replies');
    }
};

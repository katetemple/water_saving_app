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
        Schema::create('leaderboard_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leaderboard_id')->constrained()->onDelete('cascade');
            $table->foreignId('inviter_id')->constrained('users');
            $table->foreignId('invitee_id')->constrained('users');
            $table->enum('status', ['pending', 'accepted', 'denied'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaderboard_invitations');
    }
};

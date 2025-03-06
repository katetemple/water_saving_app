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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string("name"); // name of the household
            $table->unsignedBigInteger("user_id");  // ID of use who created the household
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade"); // if user deleted, associated household is also removed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('households');
    }
};

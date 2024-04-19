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
    Schema::create('business', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('address');
        $table->string('title');
        $table->string('email');
        $table->unsignedBigInteger('user_id'); // Add this line to define the user_id column
        $table->timestamps();

        // Add this line to set user_id as a foreign key
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business');
    }
};

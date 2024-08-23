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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('userID')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('funds')->default(0);
            $table->string('city')->nullable();
            $table->string('image')->default('noImage.jpg');
            $table->string('note')->nullable();
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
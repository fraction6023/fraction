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
        Schema::create('gyms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedInteger('visit_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('image')->nullable();
            $table->string('class')->nullable();
            $table->string('status')->nullable();
            $table->integer('capacity')->default(0); // capacity per hour
            $table->integer('cpd')->default(0); // cost per day
            $table->integer('cpw')->default(0); // cost per week
            $table->integer('cpm')->default(0); // cost per month
            $table->integer('cpy')->default(0); // cost per year
            $table->string('rate')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
};

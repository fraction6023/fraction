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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('gym_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('cost')->default(0);
            $table->string('approveCode')->nullable();
            $table->string('gym_rate')->nullable();
            $table->string('gym_comment')->nullable();
            $table->string('customer_rate')->nullable();
            $table->string('customer_comment')->nullable();

            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};

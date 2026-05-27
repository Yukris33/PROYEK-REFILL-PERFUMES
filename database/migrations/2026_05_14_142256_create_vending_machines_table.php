<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vending_machines', function (Blueprint $table) {
            $table->id();
            $table->string('machine_code')->unique();
            $table->string('machine_name');
            $table->string('location_name');
            $table->string('city')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('last_refill_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vending_machines');
    }
};
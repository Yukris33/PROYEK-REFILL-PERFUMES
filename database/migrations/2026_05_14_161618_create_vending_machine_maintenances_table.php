<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vending_machine_maintenances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vending_machine_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('maintenance_type');
            // sensor, esp32, qr_scanner, dispenser_pump, internet_connection, other

            $table->string('status')->default('completed');
            // scheduled | processing | completed

            $table->decimal('cost_amount', 14, 2)->default(0);

            $table->text('description')->nullable();

            $table->timestamp('maintenance_date')->nullable();

            $table->foreignId('handled_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vending_machine_maintenances');
    }
};
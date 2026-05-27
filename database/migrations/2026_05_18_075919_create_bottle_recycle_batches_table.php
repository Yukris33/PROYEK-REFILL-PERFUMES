<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bottle_recycle_batches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vending_machine_id')
                ->nullable()
                ->constrained('vending_machines')
                ->nullOnDelete();

            $table->foreignId('stock_log_id')
                ->nullable()
                ->constrained('vending_machine_stock_logs')
                ->nullOnDelete();

            $table->unsignedInteger('collected_quantity');
            $table->unsignedInteger('remaining_quantity');

            $table->enum('status', [
                'pending',
                'partial',
                'processed'
            ])->default('pending');

            $table->text('note')->nullable();

            $table->foreignId('collected_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('collected_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bottle_recycle_batches');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vending_machine_stock_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vending_machine_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('vending_machine_stock_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('product_variant_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('action_type');
            // scent_refill | empty_bottle_add | returned_bottle_collect

            $table->unsignedInteger('unit_quantity')->nullable();
            // contoh: 20 unit refill botol

            $table->unsignedInteger('volume_per_unit_ml')->nullable();
            // contoh: 50 ml

            $table->integer('stock_change');
            // +1000 ml, +50 botol, -30 botol return

            $table->unsignedInteger('previous_stock')->default(0);
            $table->unsignedInteger('new_stock')->default(0);

            $table->decimal('cost_amount', 14, 2)->default(0);

            $table->text('note')->nullable();

            $table->foreignId('performed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vending_machine_stock_logs');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vending_machine_stocks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vending_machine_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('stock_type');
            // scent | empty_bottle | returned_bottle

            $table->string('item_name');

            $table->unsignedInteger('current_stock')->default(0);
            $table->unsignedInteger('max_capacity')->default(100);

            $table->string('unit')->default('unit');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vending_machine_stocks');
    }
};
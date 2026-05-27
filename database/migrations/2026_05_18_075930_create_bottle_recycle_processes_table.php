<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bottle_recycle_processes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('batch_id')
                ->constrained('bottle_recycle_batches')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignId('product_variant_id')
                ->constrained('product_variants')
                ->cascadeOnDelete();

            $table->unsignedInteger('processed_quantity');

            $table->decimal('selling_price_per_bottle', 12, 2)->default(0);
            $table->decimal('total_inventory_value', 14, 2)->default(0);

            $table->text('note')->nullable();

            $table->foreignId('processed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('processed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bottle_recycle_processes');
    }
};
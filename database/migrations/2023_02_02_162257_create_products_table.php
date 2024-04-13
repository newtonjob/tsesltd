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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->nullable()->constrained();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->foreignId('color_id')->nullable()->constrained();
            $table->string('name')->unique();
            $table->mediumText('description')->nullable();
            $table->string('tags')->nullable();
            $table->decimal('cost_price', 10)->nullable();
            $table->decimal('price', 10)->nullable();
            $table->enum('currency', ['ngn', 'usd'])->default('ngn');
            $table->unsignedDecimal('discount')->default(0);
            $table->string('model_no')->nullable()->unique();
            $table->string('serial_no')->nullable()->unique();
            $table->timestamp('featured_at')->nullable();
            $table->string('slug')->unique();
            $table->json('subscribers')->nullable();
            $table->authors();
            $table->timestamps();
            $table->softDeletes();

            $table->fullText(['name', 'tags']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

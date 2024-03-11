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
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('sku')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('volume')->nullable();
            $table->string('option_name_en')->nullable();
            $table->string('option_name_ar')->nullable();
            $table->string('option_value_en')->nullable();
            $table->string('option_value_ar')->nullable();
            $table->decimal('price',8,2);
            $table->decimal('discount_price',8,2)->nullable();
            $table->integer('stock')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_options');
    }
};

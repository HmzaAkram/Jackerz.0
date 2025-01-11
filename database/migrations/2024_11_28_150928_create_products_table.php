<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('image');
                $table->string('image1');
                $table->string('image2');
                $table->string('image3');
                $table->string('category');
                $table->string('quantity');
                $table->string('price');
                $table->string('discount_price');
                $table->string('material');
                $table->string('size');
                $table->string('color');
                $table->string('design_type');
                $table->timestamps();
            });
        }
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

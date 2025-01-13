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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('category');
        $table->string('material');
        $table->string('size');
        $table->string('color');
        $table->string('design');
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2);
        $table->decimal('discount_price', 8, 2)->nullable();
        $table->integer('quantity');
        $table->timestamps();
    });
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

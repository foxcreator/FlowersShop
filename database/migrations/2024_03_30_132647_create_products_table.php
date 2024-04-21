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
            $table->id()->from(100);
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title_uk');
            $table->string('title_ru')->nullable();
            $table->decimal('price');
            $table->text('description_uk');
            $table->text('description_ru')->nullable();
            $table->float('quantity');
            $table->string('article');
            $table->string('thumbnail');
            $table->enum('badge', ['sale', 'newPrice', 'hit', 'new'])->nullable();
            $table->timestamps();
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

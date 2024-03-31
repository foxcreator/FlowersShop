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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->enum('delivery_option', ['courier', 'self']);
            $table->date('delivery_date');
            $table->time('delivery_time_from');
            $table->time('delivery_time_to');
            $table->enum('payment_method', ['cash', 'bank']);
            $table->enum('status', ['received', 'progress', 'awaiting', 'executed'])->default('received');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

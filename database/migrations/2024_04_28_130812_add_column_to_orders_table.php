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
        Schema::table('orders', function (Blueprint $table) {
            $table->time('delivery_time')->after('delivery_date')->nullable();
            $table->string('email')->after('id');
            $table->string('text_postcard')->after('delivery_option')->nullable();
            $table->string('anonymously')->default(false)->after('email');
            $table->string('comment')->after('status')->nullable();
            $table->string('call')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'delivery_time',
                'email',
                'text_postcard',
                'anonymously',
                'comment',
                'call',
            ]);
        });
    }
};

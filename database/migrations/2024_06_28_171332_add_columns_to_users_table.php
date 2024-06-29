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
        Schema::table('users', function (Blueprint $table) {
            $table->string('checkbox_login')->nullable()->after('remember_token');
            $table->string('checkbox_pincode')->nullable()->after('checkbox_login');
            $table->string('checkbox_key_id')->nullable()->after('checkbox_pincode');
            $table->string('checkbox_password')->nullable()->after('checkbox_key_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('checkbox_login');
            $table->dropColumn('checkbox_pincode');
            $table->dropColumn('checkbox_key_id');
            $table->dropColumn('checkbox_password');
        });
    }
};

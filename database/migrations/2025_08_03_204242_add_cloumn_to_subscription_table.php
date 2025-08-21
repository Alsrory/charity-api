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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->integer('month')->nullable()->change(); // Adding month column to subscriptions table
            $table->string('payment_method')->default('Cash')->change(); // Adding payment_method column with default value
            $table->string('status')->default('active')->change(); //
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription', function (Blueprint $table) {
            //
        });
    }
};

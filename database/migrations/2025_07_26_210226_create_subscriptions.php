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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('subscriber_id')->constrained('subscribers')->onDelete('cascade');
            $table->float('amount')->default(0); // Assuming a default amount for subscriptions
            $table->date('month')->nullable(); // Assuming a month field is needed
            $table->string('payment_method')->default('Cash'); // Assuming a payment method field is needed
            $table->string('status')->default('active'); // Assuming a status field is needed
            $table->date('paid_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

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
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('initiative_id')->constrained()->onDelete('cascade');

            $table->decimal('amount', 10, 2);
            $table->string('note')->nullable(); // Assuming a note field is needed
            $table->date('paid_at')->nullable();
            $table->string('payment_method')->default('Cash'); // Assuming a status field is needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};

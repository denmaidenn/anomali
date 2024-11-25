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
            $table->foreignId('user_id')->constrained('form_users')->onDelete('cascade');
            $table->decimal('total_price', 15, 2);
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'canceled'])->default('pending');
            $table->string('snap_token', 255)->nullable(); // Kolom untuk menyimpan Snap Token Midtrans
            $table->string('payment_url', 255)->nullable(); // Kolom untuk menyimpan URL pembayaran Midtrans
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

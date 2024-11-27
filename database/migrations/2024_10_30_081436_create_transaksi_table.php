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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('form_users')->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->decimal('amount', 15, 2); // Jumlah total pembayaran
            $table->string('payment_type')->nullable(); // Tipe pembayaran
            $table->string('status')->default('pending'); // Status pembayaran
            $table->json('midtrans_response')->nullable(); // Data respons Midtrans
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

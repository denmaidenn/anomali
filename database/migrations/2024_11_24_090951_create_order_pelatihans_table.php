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
        Schema::create('order_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('form_users')->onDelete('cascade');
            $table->foreignId('pelatihan_id')->constrained('pelatihan')->onDelete('cascade');
            $table->decimal('total_harga', 15, 2);
            $table->enum('status', ['pending', 'paid', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_pelatihans');
    }
};

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
        Schema::create('pelatihanfree', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('pelatih');
            $table->string('judul');
            $table->string('video_pelatihan');
            $table->string('gambar_pelatihan')->nullable();
            $table->text('deskripsi_pelatihan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihanfree');
    }
};

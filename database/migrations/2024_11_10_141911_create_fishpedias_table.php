<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fishpedias', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ilmiah');
            $table->enum('kategori', ['Ikan Hias Air Tawar', 'Ikan Hias Air Laut', 'Koi', 'Cupang', 'Gabus']);
            $table->string('asal');
            $table->string('ukuran');
            $table->text('karakteristik');
            $table->integer('akuarium');
            $table->integer('suhu_ideal');
            $table->decimal('ph_air', 4, 2);
            $table->string('salinitas');
            $table->string('pencahayaan');
            $table->string('gambar_ikan')->nullable(); // Gambar ikan bisa null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fishpedias');
    }
};
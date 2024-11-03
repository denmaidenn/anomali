<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishpediasTable extends Migration
{
    public function up()
    {
        Schema::create('fishpedias', function (Blueprint $table) {
            $table->id(); // Ini untuk id ikan
            $table->string('nama');
            $table->string('asal');
            $table->string('jenis');
            $table->text('deskripsi');
            $table->decimal('harga_pasar', 10, 2); // Menggunakan decimal untuk harga
            $table->string('gambar_ikan')->nullable(); // Gambar ikan bisa null
            $table->timestamps(); // Created at dan updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('fishpedias');
    }
}

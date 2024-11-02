<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishpediaTable extends Migration
{
    public function up()
    {
        Schema::create('fishpedia', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->string('nama'); // Kolom nama
            $table->string('jenis'); // Kolom jenis
            $table->string('asal'); // Kolom asal
            $table->text('deskripsi'); // Kolom deskripsi
            $table->decimal('harga_pasar', 10, 2); // Kolom harga_pasar
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('fishpedia');
    }
}

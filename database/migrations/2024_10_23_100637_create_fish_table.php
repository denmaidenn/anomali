<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fish_table', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name');
            $table->string('category');
            $table->string('origin');
            $table->string('size');
            $table->string('characteristics');
            $table->integer('aquarium_size');
            $table->string('temperature');
            $table->string('ph');
            $table->string('salinity');
            $table->string('lighting');
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
        Schema::dropIfExists('fish');
    }
}

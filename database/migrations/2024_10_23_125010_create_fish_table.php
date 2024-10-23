<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishesTable extends Migration
{
    public function up()
    {
        Schema::create('fishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name');
            $table->string('category');
            $table->string('origin');
            $table->string('size')->nullable();
            $table->text('characteristics')->nullable();
            $table->float('aquarium_size')->nullable();
            $table->float('temperature')->nullable();
            $table->float('ph')->nullable();
            $table->float('salinity')->nullable();
            $table->string('lighting')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fishes');
    }
}

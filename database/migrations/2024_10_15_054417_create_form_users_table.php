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
        Schema::create('form_users', function (Blueprint $table) {
            $table->id(); // id (int, auto-increment primary key)
            
            $table->string('name'); // name (string)
            $table->string('email')->unique(); // email (string, unique)
            $table->string('username')->unique(); // username (string, unique)
            $table->string('password'); // password (string)
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('gambar_profile')->nullable();
            $table->timestamps();
              // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_users');
    }
};

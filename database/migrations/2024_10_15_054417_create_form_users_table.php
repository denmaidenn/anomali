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
            $table->string('no_telp')->unique(); // no_telp (string, unique)
            $table->string('name'); // name (string)
            $table->string('email')->unique(); // email (string, unique)
            $table->string('username')->unique(); // username (string, unique)
            $table->string('password'); // password (string)
            $table->timestamps(); // created_at and updated_at
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

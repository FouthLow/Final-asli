<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 10)->unique(); // NISN 10 digit unik
            $table->string('nama');
            $table->string('kelas'); // Contoh: X RPL 1, XI IPA 2
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('tittle');
            $table->string('slug');

            // $table->string('author');

            // RELASI KE 1
            // Untuk Berelasi Tabel posts Berelasi Dengan Tabel users
            // $table->unsignedBigInteger('author_id');
            // $table->foreign('author_id')->references('id')->on('users');

            // Selain Menggunakan Metode Di atas Bisa Juga Menggunakan Yang Ini
            // *CATATAN* Gunakan table dan indexname jika nama kolom berbeda dengan nama table
            $table->foreignId('author_id')->constrained(
                table: 'users',
                indexName: 'posts_author_id'
            );

            // RELASI KE 2
            // *CATATAN* Gunakan kode pendek jika nama kolom selaras dedngan nama tabel
            $table->foreignId('category_id')->constrained();

            $table->text('isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

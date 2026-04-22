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
        Schema::create('destinasi', function (Blueprint $table) {

            $table->id();

            // Nama destinasi
            $table->string('nama');

            // Pantai, Alam, Kuliner, dll
            $table->string('kategori');

            // Kecamatan lokasi
            $table->string('kecamatan');

            // Deskripsi tempat
            $table->text('deskripsi')->nullable();

            // Foto / gambar
            $table->string('gambar')->nullable();

            // Rating rata-rata
            $table->decimal('rating', 3, 2)->default(0);

            // Jumlah review
            $table->integer('total_reviews')->default(0);

            // Koordinat maps
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};
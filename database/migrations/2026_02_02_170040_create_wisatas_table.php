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
        Schema::create('wisatas', function (Blueprint $table) {

            // Primary key
            $table->id();

            // Nama lokasi wisata / hotel / kuliner
            $table->string('nama');

            // Kategori wisata
            // Contoh:
            // Pantai
            // Alam
            // Bukit
            // Gua
            // Religi
            // Kuliner
            // Hotel
            // Buatan
            $table->string('kategori');

            // Harga tiket masuk
            // Gunakan 0 jika gratis atau hotel
            $table->decimal('harga_tiket', 12, 2)->default(0);

            // Koordinat GPS
            // Penting untuk maps, jarak, Haversine, PSO
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            // Jarak referensi dari pusat kota Trenggalek
            // Satuan KM
            $table->decimal('jarak_dari_pusat', 8, 2)->nullable();

            // Rating lokasi
            // Range 1.0 sampai 5.0
            $table->decimal('rating', 3, 1)->default(0);

            // Fasilitas lokasi
            // Contoh:
            // parkir, toilet, mushola, restoran, camping
            $table->text('fasilitas')->nullable();

            // Hotel terdekat dari lokasi wisata
            // Contoh:
            // Hotel Prigi, Pondok Prigi Cottage
            $table->text('hotel_terdekat')->nullable();

            // Foto utama lokasi
            // Bisa URL atau nama file lokal
            $table->string('gambar')->nullable();

            // Penjelasan singkat lokasi wisata
            $table->text('deskripsi')->nullable();

            // created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};
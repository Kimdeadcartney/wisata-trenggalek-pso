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

            // Kategori wisata (Pantai, Alam, Budaya, dll)
            $table->string('kategori');

            // Kecamatan lokasi
            $table->string('kecamatan');

            // Harga tiket masuk (0 jika gratis)
            $table->decimal('harga_tiket', 12, 2)->default(0);

            // Koordinat GPS
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            // Jarak referensi dari pusat kota Trenggalek (KM)
            $table->decimal('jarak_dari_pusat', 8, 2)->nullable();

            // Rating lokasi (1.0 - 5.0)
            $table->decimal('rating', 3, 1)->default(0);

            // Jam Operasional (Dibuat string agar bisa fleksibel/kosong)
            $table->string('jam_buka')->nullable();
            $table->string('jam_tutup')->nullable();

            // Khusus Wisata Budaya / Event Tahunan
            $table->string('tanggal_pelaksanaan')->nullable();

            // Fasilitas lokasi
            $table->text('fasilitas')->nullable();

            // Hotel terdekat
            $table->text('hotel_terdekat')->nullable();

            // Foto utama lokasi
            $table->text('gambar')->nullable();

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
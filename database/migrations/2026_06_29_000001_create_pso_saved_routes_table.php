<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel untuk menyimpan hasil optimasi rute PSO secara permanen,
     * sehingga data tidak hilang walaupun user pindah ke halaman lain.
     * Data hanya dihapus saat user menekan tombol "Reset Rute".
     */
    public function up(): void
    {
        Schema::create('pso_saved_routes', function (Blueprint $table) {
            $table->id();

            // Identifier unik sesi — bisa session_id atau user_id jika login
            $table->string('session_key')->index();

            // Data preferensi user (kategori, lokasi, budget, dll)
            $table->json('pso_data')->nullable();

            // Hasil rekomendasi destinasi PSO
            $table->json('pso_results')->nullable();

            // Hasil optimasi rute TSP-PSO (urutan_rute, total_jarak, dll)
            $table->json('pso_rute')->nullable();

            // Metadata PSO (bobot, iterasi, komparasi, dll)
            $table->json('pso_meta')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pso_saved_routes');
    }
};

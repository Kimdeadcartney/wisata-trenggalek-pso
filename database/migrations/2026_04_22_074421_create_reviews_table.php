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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            
            // Menghubungkan ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Menghubungkan ke tabel wisatas secara eksplisit
            // Menggunakan constrained('wisatas') karena nama tabel Anda bukan 'destinasis'
            $table->foreignId('wisata_id')->constrained('wisatas')->onDelete('cascade');
            
            $table->text('comment');
            $table->integer('rating')->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
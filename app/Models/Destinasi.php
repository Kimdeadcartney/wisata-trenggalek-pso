<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Penting untuk relasi

class Destinasi extends Model
{
    use HasFactory;

    /**
     * Nama tabel tetap 'wisatas' sesuai database Anda.
     */
    protected $table = 'wisatas';

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'nama',
        'kategori',
        'kecamatan', 
        'deskripsi',
        'gambar',
        'rating',
        'harga_tiket', 
        'total_reviews',
        'tanggal_pelaksanaan',
        'latitude',
        'longitude',
        'fasilitas'
    ];

    /**
     * Casting tipe data agar presisi saat perhitungan (seperti PSO atau Maps).
     */
    protected $casts = [
        'rating' => 'float',
        'harga_tiket' => 'integer',
        'total_reviews' => 'integer',
        'latitude' => 'double', // Gunakan double untuk koordinat agar lebih akurat
        'longitude' => 'double',
    ];

    /**
     * RELASI: Menghubungkan Destinasi dengan Review.
     * Fungsi ini wajib ada agar {{ $destinasi->reviews }} di Blade tidak error (null).
     */
    public function reviews(): HasMany
    {
        // Pastikan Anda memiliki model App\Models\Review
        return $this->hasMany(Review::class, 'wisata_id');
    }

    /**
     * Helper untuk mengecek jika harga_tiket adalah 0 (Gratis)
     */
    public function isGratis()
    {
        return $this->harga_tiket <= 0;
    }
}
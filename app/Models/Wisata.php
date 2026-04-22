<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan ini

class Wisata extends Model
{
    use HasFactory;

    /**
     * Nama tabel database
     */
    protected $table = 'wisatas';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'nama',
        'kategori',
        'harga_tiket',
        'latitude',
        'longitude',
        'jarak_dari_pusat',
        'rating',
        'fasilitas',
        'hotel_terdekat',
        'gambar',
        'deskripsi',
    ];

    /**
     * Konversi otomatis tipe data
     */
    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
        'harga_tiket' => 'decimal:2',
        'rating' => 'float',
        'jarak_dari_pusat' => 'float',
    ];

    /**
     * RELASI: Satu wisata memiliki banyak review
     * Ini yang memperbaiki error "null given" di foreach Blade
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'wisata_id');
    }

    /**
     * Ubah fasilitas string menjadi array
     */
    public function getFasilitasArrayAttribute()
    {
        return $this->fasilitas
            ? array_map('trim', explode(',', $this->fasilitas))
            : [];
    }

    /**
     * Ubah hotel terdekat string menjadi array
     */
    public function getHotelArrayAttribute()
    {
        return $this->hotel_terdekat
            ? array_map('trim', explode(',', $this->hotel_terdekat))
            : [];
    }

    /**
     * Cek apakah kategori adalah hotel
     */
    public function isHotel()
    {
        return strtolower($this->kategori) === 'hotel';
    }

    /**
     * Cek apakah lokasi gratis
     */
    public function isGratis()
    {
        return $this->harga_tiket <= 0;
    }
}
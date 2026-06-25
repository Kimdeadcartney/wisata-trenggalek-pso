<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisatas';

    protected $fillable = [
        'nama',
        'kategori',
        'kecamatan',
        'harga_tiket',
        'latitude',
        'longitude',
        'jarak_dari_pusat',
        'rating',
        'jam_buka',
        'jam_tutup',
        'tanggal_pelaksanaan',
        'fasilitas',
        'hotel_terdekat',
        'gambar',
        'deskripsi',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
        'harga_tiket' => 'decimal:2',
        'rating' => 'float',
        'jarak_dari_pusat' => 'float',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'wisata_id');
    }

    public function getFasilitasArrayAttribute()
    {
        return $this->fasilitas
            ? array_map('trim', explode(',', $this->fasilitas))
            : [];
    }

    public function getHotelArrayAttribute()
    {
        return $this->hotel_terdekat
            ? array_map('trim', explode(',', $this->hotel_terdekat))
            : [];
    }

    public function isHotel()
    {
        return strtolower($this->kategori) === 'hotel';
    }

    public function isGratis()
    {
        return $this->harga_tiket <= 0;
    }
}
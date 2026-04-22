<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'wisata_id',
        'comment',
        'rating',
    ];

    /**
     * Mendapatkan user yang memiliki review ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
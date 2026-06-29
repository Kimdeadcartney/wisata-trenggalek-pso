<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsoSavedRoute extends Model
{
    protected $fillable = [
        'session_key',
        'pso_data',
        'pso_results',
        'pso_rute',
        'pso_meta',
    ];

    protected $casts = [
        'pso_data'    => 'array',
        'pso_results' => 'array',
        'pso_rute'    => 'array',
        'pso_meta'    => 'array',
    ];
}

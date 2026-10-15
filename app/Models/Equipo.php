<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'estado',
    ];

    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }
}
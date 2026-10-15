<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestamo extends Model
{
    protected $fillable = [
        'equipo_id',
        'estudiante_id',
        'encargado_id',
        'fecha_prestamo',
        'fecha_entrega',
        'fecha_devolucion',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_prestamo' => 'datetime',
            'fecha_entrega' => 'datetime',
            'fecha_devolucion' => 'datetime',
        ];
    }

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'estudiante_id');
    }

    public function encargado(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'encargado_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaccion',
        'nombre',
        'codigo_postal',
        'email',
        'telefono',
        'rfc',
        'selected_assistances',
        'total_price',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];
}

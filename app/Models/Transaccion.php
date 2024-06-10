<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaccion',
        'productDetails_description',
        'amountDetails_totalAmount',
        'amountDetails_currency',
    ];

    protected $casts = [
        'amountDetails_totalAmount' => 'decimal:2',
    ];
}

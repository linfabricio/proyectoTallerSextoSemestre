<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['cuenta_id', 'monto'];

    // Relación con la cuenta
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }
}

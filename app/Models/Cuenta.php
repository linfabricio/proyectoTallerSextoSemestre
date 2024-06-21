<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'balance',
        'payment_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define la relación inversa con el alumno
    public function alumno()
    {
        return $this->belongsTo(alumno::class);
    }

    // Suponiendo que tienes un campo 'estado' para verificar si la cuenta está pendiente
    public function scopePendiente($query)
    {
        return $query->where('estado', 'pendiente');
    }
}

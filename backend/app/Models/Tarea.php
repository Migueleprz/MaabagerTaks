<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'trabajadorId',
        'title',
        'description',
        'delivery_date',
        'status',
        'observation',
        'observation_date'
    ];

    public function Trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'trabajadorId');
    }
}

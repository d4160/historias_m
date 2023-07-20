<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KardexDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'kardex_id',
        'medicamento',
        'dosis',
        'via',
        'frecuencia',
        'dia1',
        'dia2',
        'dia3',
        'dia4',
        'dia5',
        'dia6',
        'dia7',
        'dia8'
    ];

    public function kardex() {
        return $this->belongsTo('App\Models\Kardex');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_hora',
        'tipo',
        'consultorio',
        'medico',
        'estado',
        'origen',
        'paciente_id',
        'tipo_otros'
    ];

    public function paciente() {
        return $this->belongsTo('App\Models\Paciente');
    }

}

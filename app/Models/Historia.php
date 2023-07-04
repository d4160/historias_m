<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'antecedente_id',
        'anamnesis_id',
        'examen_clinico_id',
        'examen_regional_id',
        'impresion_diagnostica_id',
        'tratamiento_id',
        'proxima_cita'
    ];

    public function paciente() {
        return $this->belongsTo('App\Models\Paciente');
    }

    public function anamnesis() {
        return $this->belongsTo('App\Models\Anamnesis');
    }

    public function antecedente() {
        return $this->belongsTo('App\Models\Antecedente');
    }

    public function examenClinico() {
        return $this->belongsTo('App\Models\ExamenClinico');
    }

    public function examenRegional() {
        return $this->belongsTo('App\Models\ExamenRegional');
    }

    public function examenesAuxiliares($order = 'desc') {
        return $this->hasMany('App\Models\ExamenAuxiliar')->orderBy('created_at', $order);
    }

    public function impresionDiagnostica() {
        return $this->belongsTo('App\Models\ImpresionDiagnostica');
    }

    public function tratamiento() {
        return $this->belongsTo('App\Models\Tratamiento');
    }
}

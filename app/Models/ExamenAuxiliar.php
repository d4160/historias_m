<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenAuxiliar extends Model
{
    use HasFactory;

    protected $table = 'examenes_auxiliares';

    protected $fillable = [
        'historia_id',
        'titulo',
        'descripcion',
        'url',
        'viewer_url',
        'download_url',
        'medico_1_id',
        'medico_2_id',
        'medico_3_id'
    ];

    public function historia() {
        return $this->belongsTo('App\Models\Historia');
    }
}

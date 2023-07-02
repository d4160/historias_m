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
        'url'
    ];

    public function historia() {
        $this->belongsTo('App\Models\Historia');
    }
}

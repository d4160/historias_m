<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;

    protected $fillable = [
        'historia_id',
        'observaciones',
        'exam_lab',
        'exam_imagen',
        'reevaluacion'
    ];

    public function detalles() {
        return $this->hasMany('App\Models\KardexDetalle');
    }

    public function historia() {
        return $this->belongsTo('App\Models\Historia');
    }
}

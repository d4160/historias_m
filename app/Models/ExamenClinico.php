<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenClinico extends Model
{
    use HasFactory;

    protected $table = 'examenes_clinicos';

    protected $fillable = [
        'historia_id',
        'fc',
        'fr',
        'sat',
        'temperatura',
        'peso',
        'talla',
        'deposiciones',
        'orina',
        'fur',
        'otros'
    ];

    public function historia() {
        $this->belongsTo('App\Models\Historia');
    }
}

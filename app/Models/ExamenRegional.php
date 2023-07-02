<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenRegional extends Model
{
    use HasFactory;

    protected $table = 'examenes_regionales';

    protected $fillable = [
        'historia_id',
        'examen_regional'
    ];

    public function historia() {
        $this->belongsTo('App\Models\Historia');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpresionDiagnostica extends Model
{
    use HasFactory;

    protected $table = 'impresiones_diagnosticas';

    protected $fillable = [
        'historia_id',
        'impresion_diagnostica'
    ];

    public function historia() {
        $this->belongsTo('App\Models\Historia');
    }
}

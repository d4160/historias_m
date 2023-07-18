<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'tabla',
        'accion',
        'user_id',
        'tabla_id',
        'detalles'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;

    protected $fillable = [
        'historia_id',
        'observaciones'
    ];

    public function detalles() {
        return $this->hasMany('App\Models\KardexDetalle');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'historia_id',
        'tratamiento'
    ];

    public function historia() {
        $this->belongsTo('App\Models\Historia');
    }
}

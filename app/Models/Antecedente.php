<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;

    protected $fillable = [
        'historia_id',
        'antecedentes'
    ];

    public function historia() {
        $this->belongsTo('App\Models\Historia');
    }
}

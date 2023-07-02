<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    use HasFactory;

    protected $table = 'anamnesis';

    protected $fillable = [
        'historia_id',
        'anamnesis'
    ];

    public function historia() {
        $this->belongsTo('App\Models\Historia');
    }
}

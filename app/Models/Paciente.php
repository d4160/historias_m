<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo',
        'proxima_cita',
        'estado'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function historias() {
        return $this->hasMany('App\Models\Historia')->orderBy('created_at', 'desc');
    }

    public function citas() {
        return $this->hasMany('App\Models\Cita')->orderBy('created_at', 'desc');
    }
}

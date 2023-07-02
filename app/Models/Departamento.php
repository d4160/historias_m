<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $primaryKey = 'codigo_dep';
    public $incrementing = false;

    public function provincias() {
        return $this->hasMany('App\Models\Provincia', 'codigo_dep', 'codigo_dep');
    }
}

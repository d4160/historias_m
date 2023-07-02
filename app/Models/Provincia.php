<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $primaryKey = 'codigo_prov';
    public $incrementing = false;

    public function distritos() {
        return $this->hasMany('App\Models\Distrito', 'codigo_prov', 'codigo_prov');
    }
}

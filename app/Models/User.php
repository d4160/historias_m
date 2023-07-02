<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_role_id',
        'num_document',
        'first_names',
        'last_name1',
        'last_name2',
        'fecha_nacimiento',
        'edad',
        'procedencia_dep',
        'procedencia_prov',
        'procedencia_dis',
        'direccion',
        'estado_civil',
        'ocupacion',
        'otros',
        'specific_role_id',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo('App\Models\UserRole');
    }

    public function getFullNameAttribute() {
        return ucfirst($this->first_names) . ' ' . ucfirst($this->last_name1) . ' ' . ucfirst($this->last_name2);
    }

    public function getLastNamesAttribute() {
        return ucfirst($this->last_name1) . ' ' . ucfirst($this->last_name2);
    }

    public function isAdmin() {
        return $this->user_role_id > 0 && $this->user_role_id < 5 ? true : false;
    }

    public function isPatient() {
        return $this->user_role_id === 5 ? true : false;
    }

    public function patientId() {
        return Paciente::find($this->specific_role_id)->id;
    }

    public function patient() {
        return Paciente::find($this->specific_role_id);
    }
}

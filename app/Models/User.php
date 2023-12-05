<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Arr;

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
        'celular',
        'refiere',
        'medico_tratante',
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

    public function paciente() {
        return $this->belongsTo('App\Models\Paciente', 'specific_role_id', 'id');
    }

    public function medico() {
        return $this->belongsTo('App\Models\Medico', 'specific_role_id', 'id');
    }

    public function historias() {
        return $this->belongsTo('App\Models\Historia', 'specific_role_id', 'paciente_id');
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

    public function examenesAuxiliares() {
        $historias = Paciente::find($this->specific_role_id)->historias;
        $exams = [];

        foreach($historias as $h) {
            foreach($h->examenesAuxiliares as $e) {
                $exams = Arr::add($exams, $e->id, $e);
            }
        }

        return collect($exams)->sortBy('updated_at')->reverse()->toArray();;
    }

    public function provincia() {
        return $this->belongsTo('App\Models\Provincia', 'procedencia_prov', 'codigo_prov');
    }
}

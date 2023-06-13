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
        'last_names',
        'email',
        'password',
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

    public function results() {
        return $this->hasMany('App\Models\OnlineResult')->orderBy('created_at', 'desc');
    }

    public function getFullNameAttribute() {
        return ucfirst($this->first_names) . ' ' . ucfirst($this->last_names);
    }

    public function isAdmin() {
        return $this->user_role_id === 1 || $this->user_role_id === 2 ? true : false;
    }
}

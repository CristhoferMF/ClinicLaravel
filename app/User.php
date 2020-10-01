<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol','rol_user', 'user_id', 'rol_id');
    }

    public function tipoDocumento()
    {
        return $this->hasOne('App\Models\TipoDocumento');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_type_id', 'document_number', 'last_name',
        'first_name', 'born_date',
        'phone', 'gender', 'email','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

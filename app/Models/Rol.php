<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User', 'rol_user', 'user_id', 'rol_id');
    }
}

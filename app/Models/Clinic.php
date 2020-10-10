<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const PENDING = 'pending';

    protected $fillable = ['name','description','status','address'];
    
    public static function getActive(){
        return Clinic::where('status', Clinic::ACTIVE);
    }

    public function scopeNames($query){
        return $query->select('id','name');
    }

    public function getIdAndName(){
        return $this->id.' - '.$this->name;
    }

    public function specialties()
    {
        return $this->hasMany('App\Models\Specialty');
    }
    
    public function countSpecialties(){
        return $this->specialties()->count();
    }
}

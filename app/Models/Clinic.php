<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = ['name','description','status','address'];
    
    public static function getActive(){
        return Clinic::where('status','==','active');
    }

    public function specialties()
    {
        return $this->hasMany('App\Models\Specialty');
    }
    
    public function countSpecialties(){
        return $this->specialties()->count();
    }
}

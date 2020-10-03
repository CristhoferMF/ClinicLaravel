<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = ['name','description','status','address'];

    public static function  getNotDeleted(){
        return Clinic::where('status','<>','deleted');
    }
    
    public static function getActive(){
        return Clinic::where('status','==','active');
    }
}

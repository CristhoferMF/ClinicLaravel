<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Availability extends Model
{
    //
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    
    protected $fillable = ['doctor_id','specialty_id','from_hour','to_hour','day','max_patients','from_date','to_date','status'];
    //
    public function setFromDateAttribute($value)
    {
        $this->attributes['from_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    public function specialty()
    {
        return $this->belongsTo('App\Models\Specialty');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
    public function getDay(){
        $arrDias = ['D','L','M','W','J','V','S'];
        return $arrDias[$this->day];
    }
    public function setToDateAttribute($value)
    {
        $this->attributes['to_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setToHourAttribute($value)
    {
        $this->attributes['to_hour'] = Carbon::createFromFormat('h:i A', $value)->format('H:i');
    }

    public function setFromHourAttribute($value)
    {
        $this->attributes['from_hour'] = Carbon::createFromFormat('h:i A', $value)->format('H:i');
    }

    public function scopeActive($query){
        return $query->where('status',Availability::ACTIVE);
    }
    public function scopeOrderByDay($query,$order = 'ASC'){
        return $query->orderBy('day',$order);
    }
    public function scopeOrderByFromHour($query,$order = 'ASC'){
        return $query->orderBy('from_hour',$order);
    }
}

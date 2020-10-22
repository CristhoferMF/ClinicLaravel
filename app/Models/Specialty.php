<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class Specialty extends Model
{
    //
    protected $fillable = ['clinic_id','name','description'];

    public function clinic()
    {
        return $this->belongsTo('App\Models\Clinic');
    }

    public function createdAtParseDiffForHumans() {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }

    public function scopeOnlyName($query){
        return $query->select('id','name');
    }
    public function scopeSelectNameAndClinicId($query){
        return $query->select('id','name','clinic_id');
    }
    public function scopeGetBasicInfoClinic($query){
        return $query->with('clinic:id,name');
    }
    public function scopegetFullInfoClinic($query){
        return $query->with('clinic');
    }
    public static function getSpecialtiesWithClinicName(){

        return Specialty::with(['clinic' => function($query){
            $query->names();
        }]);

    }

    public function scopeSpecialtiesByClinicId($query,$id){

        return $query->whereHas('clinic', function ($query) use ($id) {
            return $query->where('id', '=', $id);
        });
    }

    public static function anyDataDatatable(){

        $specialties = Specialty::getSpecialtiesWithClinicName();
                
        return Datatables::of($specialties)
            ->editColumn('clinic.name',function (Specialty $specialty) {
                return '<a href="'.route('clinics.show', ['id' => $specialty->clinic->id] ).'" target="_blank">'.$specialty->clinic->getIdAndName().'</a>';
            })
            ->editColumn('created_at',function ($specialty) {
                return $specialty->createdAtParseDiffForHumans();
            })
            ->filterColumn('clinic.name',function ($query, $keyword) {
                $query->SpecialtiesByClinicId($keyword);
            })
            ->addColumn('action','specialties.datatables.actions')
            ->rawColumns(['action','clinic.name'])
            ->make(true);
    }
    
}

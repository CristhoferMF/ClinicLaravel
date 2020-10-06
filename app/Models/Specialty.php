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

    public static function getSpecialtiesWithClinicName(){

        return Specialty::with(['clinic' => function($query){
            $query->select('id','name');
        }])->get();

    }
    public static function anyDataDatatable(){

        $specialties = Specialty::getSpecialtiesWithClinicName();
                
        return Datatables::of($specialties)
            ->editColumn('clinic.name',function (Specialty $specialty) {
                return '<a href="'.route('clinics.show', ['id' => $specialty->clinic->id] ).'" target="_blank">
                            '.$specialty->clinic->id.' - '.$specialty->clinic->name.'
                        </a>';
            })
            ->editColumn('created_at',function ($specialty) {
                $fecha = Carbon::parse($specialty->created_at)->diffForHumans(Carbon::now());
                return $fecha;
            })
            ->addColumn('action','specialties.datatables.actions')
            ->rawColumns(['action','clinic.name'])
            ->make(true);
    }
    
}

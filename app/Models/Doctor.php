<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class Doctor extends Model
{
    //
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    protected $fillable = ['first_name','last_name','document_type_id','gender','document_number','status'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function documentType()
    {
        return $this->belongsTo('App\Models\DocumentType')->withDefault();
    }

    public function createdAtParseDiffForHumans() {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }

    public function scopeActive($query){
        return $query->where('status',Doctor::ACTIVE);
    }

    public function isInactive(){
        return $this->status == Doctor::INACTIVE;
    }
    
    public function getFullName($isUpper = false){

        $fullname = $this->last_name." ".$this->first_name;

        return ($isUpper) ? \Str::upper($fullname) : $fullname;
    }

    public function scopeStatus($query,$status){
        return $query->where('status',$status);
    }

    public function scopeWhereFullNameLike($query,$keyword){
        return $query->whereRaw("CONCAT(doctors.last_name,' ',doctors.first_name) like ?", ["%{$keyword}%"]);
    }

    public static function getDoctorsWithDocumentName(){
        return Doctor::with(['documentType' => function ($query) {
            return $query->select(['id','name']);
        }]);
    }
    public static function getActiveDoctorsWithDocumentName(){
        return Doctor::getDoctorsWithDocumentName()->active();
    }

    public static function anyDataDatatable(){

        $doctors = Doctor::getDoctorsWithDocumentName();

        return DataTables::of($doctors)
                ->editColumn('created_at',function ($doctor) {
                    return $doctor->createdAtParseDiffForHumans();
                })
                ->filterColumn('status', function($query, $keyword) {
                    $query->status($keyword);
                })
                ->filterColumn('name', function($query, $keyword) {
                    $query->WhereFullNameLike($keyword);
                })
                ->rawColumns(['actions'])
                ->setRowClass(function ($doctor) {
                    return ($doctor->isInactive()) ? 'table-warning' : null;
                })
                ->addColumn('name', function ($doctor){
                    return $doctor->getFullName(true); 
                })
                ->addColumn('actions','doctors.includes.actions')
                ->toJson(true);
    }
}

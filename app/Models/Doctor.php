<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class Doctor extends Model
{
    //
    protected $fillable = ['first_name','last_name','document_type_id','gender','document_number','status'];

    public function documentType()
    {
        return $this->belongsTo('App\Models\DocumentType')->withDefault();
    }

    public static function getDoctorsWithDocumentName(){
        return Doctor::with(['documentType' => function ($query) {
            return $query->select(['id','name']);
        }]);
    }

    public static function anyDataDatatable(){

        $doctors = Doctor::getDoctorsWithDocumentName();

        return DataTables::of($doctors)
                ->editColumn('created_at',function ($doctor) {
                    return Carbon::parse($doctor->created_at)->diffForHumans(Carbon::now());
                })
                ->addColumn('name', function ($doctor){
                    return \Str::upper($doctor->last_name." ".$doctor->first_name); })
                ->addColumn('actions','doctors.includes.actions')
                ->filterColumn('status', function($query, $keyword) {
                    $query->where('status',$keyword);
                })
                ->filterColumn('name', function($query, $keyword) {
                    $query->whereRaw("CONCAT(doctors.last_name,' ',doctors.first_name) like ?", ["%{$keyword}%"]);
                })
                ->rawColumns(['actions'])
                ->setRowClass(function ($doctor) {
                    if($doctor->status == 'inactive'){
                        return 'table-warning';
                    }
                })
                ->make(true);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Clinic;
use App\Models\Availability;
use App\Http\Requests\StoreAvailabilityRequest;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AvailabilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clinics = Clinic::all();

        return view('availabilities.index' , compact('clinics') );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        //


        $availabilities = Availability::with(
            [
                'specialty' => function ($query) {
                    return $query->select('id','name','clinic_id')->with(['clinic' => function($query){
                        return $query->select('id','name');
                    }]);},
                'doctor' => function ($query) {
                    return $query->select('id','first_name','last_name','document_number');
                }
            ]
        );

        return Datatables::of($availabilities)
        ->editColumn('doctor.full_name', function ($availability){
            return $availability->doctor->getFullName(true);
        })
        ->editColumn('specialty.clinic_name', function ($availability) {
            return $availability->specialty->clinic->getIdAndName();
        })
        ->editColumn('day', function ($availability) {
            return $availability->getDay();
        })
        ->filterColumn('doctor.last_name', function($query, $keyword) {
            $query->whereHas('doctor',function ($query) use ($keyword) {
                $query->whereFullNameLike($keyword);
            });
        })
        ->filterColumn('status', function ($query,$keyword) {
            $query->where('status',$keyword);
        })
        ->addColumn('actions','availabilities.includes.actions')
        ->rawColumns(['actions'])
        ->setRowClass(function ($availability) {
            return ($availability->status != Availability::ACTIVE ) ? 'table-warning' : null;
        })
        ->toJson(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $doctors = Doctor::getActiveDoctorsWithDocumentName()->get()->toJson();
        $clinics = Clinic::names()->get()->toJson();

        return view('availabilities.create', compact('doctors','clinics') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAvailabilityRequest $request)
    {
        //
        $validated = $request->validated();
        
        $availability = Availability::create($validated);

        return response()->json(['status' => 200 , 'message' => 'La disponibilidad fue agregada con éxito' , 'data' => $availability]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Availability::destroy($id);

        notify()->preset('destroy');

        return redirect()->route('availabilities.index');
    }
}

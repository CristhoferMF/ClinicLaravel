<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Clinic;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Http\Requests\StoreSpecialtyRequest;

class SpecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clinics = Clinic::getNotDeleted()->get();
        $specialty = new Specialty();
        
        return view('specialties.index')->with(['clinics' => $clinics, 'specialty' => $specialty]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $specialties = Specialty::with(['clinic' => function($query){
            $query->select('id','name');
        }])->get();
                
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
            ->addColumn('action',function ($specialty) {
                return '<a href="'.route('specialties.edit',['id' => $specialty->id]).'" class="btn btn-sm btn-warning text-black-50">
                            <i class="fas fa-edit"></i> Editar
                        </a>';
            })
            ->rawColumns(['action', 'clinic.name'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecialtyRequest $request)
    {
        //
        $validated = $request->validated();
        
        $checkifexists = Specialty::where([
            ['clinic_id','=',$validated['clinic_id']],
            ['name','=',$validated['name']],
        ]);
        
        if($checkifexists){

            notify()->error('Ya existe esta especialidad en esta sede','No se agrego la especialidad');
            return redirect()->back()->withInput();
        }

        $specialty = Specialty::create($validated);

        notify()->success('La operación de agregar una especialidad fue realizada con éxito','Se agrego una especialidad');
        
        return redirect(route('specialties.index'));
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
        $specialty = Specialty::find($id);
        $clinics = Clinic::getNotDeleted()->get();

        return view('specialties.edit')->with(['specialty' => $specialty,'clinics' => $clinics]);
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
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClinicRequest;
use App\Models\Clinic;

class ClinicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('clinics.index')->with([
            'clinics' => Clinic::all(),
            '_clinic' => new Clinic()
        ]);
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
    public function store(StoreClinicRequest $request)
    {
        
        $ClinicValidated = $request->validated();

        try {
            Clinic::create($ClinicValidated);
            notify()->preset('create');

        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            notify()->error($errorInfo[2]);

        }

        return redirect(route('clinics.index').'#clinics-table');

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
        $clinic = Clinic::find($id);
        
        if (empty($clinic)) { abort(404); }

        $countEspecialidades = $clinic->countSpecialties();

        return view('clinics.show', compact('clinic','countEspecialidades'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function specialties($id)
    {
        //
        $clinic = Clinic::findOrFail($id);
        $specialties = $clinic->specialties()->onlyName()->get();
        
        return $specialties;
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
        $clinic = Clinic::find($id);
        
        if (empty($clinic)) { abort(404); }

        return view('clinics.edit' , compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClinicRequest $request, $id)
    {
        
        try {
            $clinic = Clinic::find($id)->fill($request->all());
            $clinic->save();

            notify()->preset('update');

            return redirect()->route('clinics.index');

        } catch (\Illuminate\Database\QueryException $exception) {
            notify()->error($exception->errorInfo[2]);
            return redirect()->back();
        }

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
        try {
            $clinic = Clinic::find($id);
            
            if($clinic->countSpecialties()){
                notify()->error('Hay especialidades en este sede. Borre las especialidades primero.');
                return redirect()->back();
            }
            
            $clinic->delete();
            notify()->preset('destroy');
            
        } catch (\Illuminate\Database\QueryException $exception) {

            notify()->error($exception->errorInfo[2]);
        }

        return redirect(route('clinics.index').'#clinics-table');
    }
}

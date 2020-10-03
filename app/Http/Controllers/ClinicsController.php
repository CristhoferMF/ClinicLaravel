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
        $clinics = Clinic::getNotDeleted()->get();
    
        return view('clinics.index')->with([
            'clinics' => $clinics,
            'clinic' => new Clinic()
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
            $clinic = Clinic::create($ClinicValidated);
            notify()->success('La operación de crear una sede fue realizada con éxito','Se creo la sede');

        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            notify()->error($errorInfo);

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
        //
        $clinic = Clinic::getNotDeleted()->find($id);
        
        if (empty($clinic)) { abort(404); }

        return view('clinics.show')->with(['clinic' => $clinic]);
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
        $clinic = Clinic::getNotDeleted()->find($id);
        
        if (empty($clinic)) { abort(404); }

        return view('clinics.edit')->with(['clinic' => $clinic]);
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
            $clinic = Clinic::find($id);
            $clinic->fill($request->all());
            $clinic->save();

            notify()->success('La operación de editar una sede fue realizada con éxito','Se actualizo la sede');

            return redirect(route('clinics.index'));

        } catch (\Illuminate\Database\QueryException $exception) {

            notify()->error($exception->errorInfo);

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
            $clinic->status = 'deleted';
            $clinic->save();

            notify()->info('La operación de eliminar la sede fue realizada con éxito','Se eliminó la sede');

        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            notify()->error($errorInfo);
        }

        return redirect(route('clinics.index').'#clinics-table');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Clinic;
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
        $clinics = Clinic::all();
        $specialty = new Specialty();
        
        return view('specialties.index')->with(['clinics' => $clinics, 'specialty' => $specialty]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        $data = Specialty::anyDataDatatable();
        return $data;
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
    
        $specialty = Specialty::create($validated);

        notify()->preset('create');

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
        $specialty = Specialty::find($id);
        
        if (empty($specialty)) { abort(404); }

        return view('specialties.show')->with([
            'specialty' => $specialty
        ]);
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

        if (empty($specialty)) { abort(404); }

        $clinics = Clinic::all();

        return view('specialties.edit')->with(['specialty' => $specialty,'clinics' => $clinics]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSpecialtyRequest $request, $id)
    {
        //
        try {
            $validated = $request->validated();
            
            $specialty = Specialty::find($id);
            $specialty->fill($request->all());
            $specialty->save();

            notify()->preset('update');

            return redirect()->route('specialties.index');

        } catch (\Illuminate\Database\QueryException $exception) {
            notify()->error($exception->errorInfo[2]);
            return redirect()->back()->withInput();
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
        Specialty::destroy($id);

        notify()->preset('destroy');

        return redirect(route('specialties.index'));
    }
}

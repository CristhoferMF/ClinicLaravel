<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DocumentType;
use App\Http\Requests\DoctorRequest;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $_doctor = new Doctor();

        $documentTypes = DocumentType::all();
        
        return view('doctors.index')->with([
            '_doctor' => $_doctor,
            'documentTypes' => $documentTypes
        ]);
    }

    /**
     * 
     * 
     * @return \Iluminate\Http\JsonResponse;
     */
    public function datatable(){

        return Doctor::anyDataDatatable();
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
    public function store(DoctorRequest $request)
    {
        //
        $validated = $request->validated();
        
        Doctor::create($validated);

        notify()->preset('create');

        return redirect()->route('doctors.index');

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
        $doctor = Doctor::with('documentType')->find($id);
        
        if(empty($doctor)) { abort(404); }

        return view('doctors.show')->with([
            'doctor' => $doctor
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
        $doctor = Doctor::find($id);
        $documentTypes = DocumentType::all();
        
        if(empty($doctor)) { abort(404); }

        return view('doctors.edit')->with([
            'doctor' => $doctor,
            'documentTypes' => $documentTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, $id)
    {
        //
        $validated = $request->validated();

        $doctor = Doctor::find($id);
        $doctor->fill($validated);
        $doctor->save();

        notify()->preset('update');

        return redirect()->route('doctors.index');
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
        Doctor::destroy($id);

        notify()->preset('destroy');

        return redirect()->route('doctors.index');
    }
}

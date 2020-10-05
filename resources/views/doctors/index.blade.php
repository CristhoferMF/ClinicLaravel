@extends('layouts.app')

@section('content')
    
    <h1 class="h3 mb-4 text-gray-800">Doctores</h1>

    <div class="row d-none">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary m-0">Tabla de doctores</h6>
                </div>
                <div class="card-body">
                    <div style="height: 300px"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="offset-md-1 col-md-10">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Agregar doctor</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-md-block text-center d-none">
                            <img class="img-fluid px-3 px-sm-4 mt-4" style="max-height: 12rem" 
                            src={{asset('img/undraw_doctor_kw5l.svg')}} alt="">
                        </div>
                        <div class="col-md-6">
                            @include('doctors.form',[
                                'URL' => route('doctors.store'),
                                'method' => 'POST',
                                'doctor' => $_doctor,
                            ])
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <h1 class="h3 text-gray-800 mb-4">Doctores / Información</h1>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-primary m-0 font-weight-bold">Doctor ID: {{$doctor->id}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 d-lg-block d-none text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-4" style="max-height: 12rem" 
                            src={{asset('img/undraw_doctor_kw5l.svg')}} alt="">
                        </div>
                        <div class="col-lg-6">
                            <h4>{{$doctor->last_name}} {{$doctor->first_name}}</h4>
                            <p style="line-height: 2rem" class="">
                                <strong>Tipo de Documento: </strong> {{$doctor->documentType->name}}<br>
                                <strong>Número de Documento: </strong> {{$doctor->document_number}}<br>
                                <strong>Género: </strong> {{$doctor->gender}}<br>
                                <strong>Estado: </strong> {{$doctor->status}}<br>
                                <strong>Creado el: </strong> {{\Carbon\Carbon::parse($doctor->created_at)->format('d/M/Y h:i a')}}<br>
                            </p>
                            <hr class="my-4">
                            <div class="w-100 text-center">
                                <a href="{{route('doctors.index')}}" class="small text-primary">Ir atras</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
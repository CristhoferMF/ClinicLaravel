@extends('layouts.app')

@section('content')
<div class="mb-2">
    <h1 class="h3 text-gray-800">Sedes / Información</h1>
    <p class="mb-4">
        Administra las sedes de la clinica. Añade una nueva, actualiza sus datos o altera el estado de la misma.
    </p>
</div>



<div class="row">
    <div class=" offset-xl-2 col-xl-8 offset-lg-3 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header">
            <h6 class="text-primary font-weight-bold m-0">Sede ID: {{$clinic->id}}</h6>
            </div>
            <div class="card-body">
                <h3 class="text-center mb-4">{{$clinic->name}}</h3>
                <p>Dirección: {{$clinic->address}}</p>
                <p>Estado: {{$clinic->status}}</p>
                <p>Descripción: {{$clinic->description}}</p>
                <hr class="my-4">
                <div class="w-100 text-center">
                    <a href="{{route('clinics.index')}}" class="small text-primary">Ir atras</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

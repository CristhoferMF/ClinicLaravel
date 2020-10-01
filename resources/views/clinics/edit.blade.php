@extends('layouts.app')

@section('content')
<div class="mb-2">
    <h1 class="h3 text-gray-800">Sedes / Editar Sede</h1>
    <p class="mb-4">
        Administra las sedes de la clinica. Añade una nueva, actualiza sus datos o altera el estado de la misma.
    </p>
</div>



<div class="row">
    <div class=" offset-xl-2 col-xl-8 offset-lg-3 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header">
            <h6 class="text-primary font-weight-bold m-0">ID: {{$id}}</h6>
            </div>
            <div class="card-body">
                @include('clinics.form')
                <hr class="my-4">
                <div class="w-100 text-center">
                    <a href="{{route('sedes.index')}}" class="small text-primary">Ir atras</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

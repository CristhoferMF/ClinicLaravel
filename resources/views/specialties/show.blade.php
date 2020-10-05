@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="h3 text-gray-800">Sedes / Información</h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Doctores</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Total: %%</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-hospital fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

<div class="row">
    <div class=" offset-xl-2 col-xl-8 offset-lg-3 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header">
            <h6 class="text-primary font-weight-bold m-0">Editar especialidad</h6>
            </div>
            <div class="card-body">
            <h3 class="text-center mb-4">{{$specialty->name}}</h3>
                <p>
                    <strong>SEDE:</strong> {{$specialty->clinic->name}}
                </p>
                <p>
                    <strong>Descripción: </strong>{{$specialty->description}}
                </p>
                <hr class="my-4">
                <div class="w-100 text-center">
                    <a href="{{route('specialties.index')}}" class="small text-primary">Ir atras</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

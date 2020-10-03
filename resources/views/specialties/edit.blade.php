@extends('layouts.app')

@section('content')
    <h1 class="h3 text-gray-800 mb-4">Especialidades / Editar</h1>
    <div class="row">
        <div class="col-12 offset-3 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Editar Especialidad</h6>
                </div>
                <div class="card-body">
                    @include('specialties.form',[
                        'method' => 'PATCH',
                        'URL' => route('specialties.update',[ 'id' => $specialty->id]),
                        'specialty' => $specialty
                    ])
                    <hr class="my-4">
                    <div class="w-100 text-center">
                        <a href="{{route('specialties.index')}}" class="small text-primary">Ir atras</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
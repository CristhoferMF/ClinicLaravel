@extends('layouts.app')

@section('content')
    <h1 class="h3 text-gray-800 mb-4">Doctores / Editar</h1>
    <div class="row">
        <div class="col-12 offset-3 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Editar Doctor</h6>
                </div>
                <div class="card-body">
                    @include('doctors.form',[
                        'method' => 'PATCH',
                        'URL' => route('doctors.update',[ 'id' => $doctor->id]),
                        'doctor' => $doctor
                    ])
                    <hr class="my-4">
                    <div class="w-100 text-center">
                        <a href="{{route('doctors.index')}}" class="small text-primary">Ir atras</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('scripts')

<script>
    $('#clinics-table').DataTable({
        responsive:true,
        columnDefs: [
                { width : "8rem", targets: 1 },
                { width : "15%", targets: 4 },
                { width : "6rem", targets: 6 },
            ],
    });
    $('#clinics-table form').on('submit',function(e){
        
        var alert_confirm = confirm('Se borrar la sede. Esta acción no se puede deshacer')
        
        if(!alert_confirm){
            e.preventDefault();
        }
    })
   
</script>
@endsection


@section('content')
<h1 class="h3 mb-2 text-gray-800">Sedes</h1>
<p class="mb-4">
    Administra las sedes de la clinica. Añade una nueva, actualiza sus datos o altera el estado de la misma.
</p>


<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold">Nuestras Sedes</h6>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover " id="clinics-table">
                        <thead class="thead-default">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Descripción</th>
                                <th>Fecha de creación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinics as $clinic)
                            <tr>
                                <td scope="row">
                                <a href="{{route('clinics.show',[$clinic->id])}}">{{$clinic->id}}</a>
                                </td>
                                <td>{{$clinic->name}}</td>
                                <td>{{$clinic->address}}</td>
                                <td>{{$clinic->description}}</td>
                                <td>{{\Carbon\Carbon::parse($clinic->created_at)->diffForHumans(\Carbon\Carbon::now())}}</td>
                                {{-- <td>{{$clinic->updated_at}}</td> --}}
                                <td>{{$clinic->status}}</td>
                                <td align="center">
                                    @include('includes.actions_table',['URL' => [
                                        'show' => route('clinics.show',[$clinic->id]) ,
                                        'edit' => route('clinics.edit',[$clinic->id]) ,
                                        'destroy' => route('clinics.destroy',[$clinic->id])
                                    ]])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold m-0">Agregar Sede</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-5 d-xl-block d-none text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-4" style="max-height: 12rem" 
                        src="{{asset('img/undraw_doctors_hwty.svg')}}" alt="">
                    </div>
                    <div class="col-xl-7">
                        @include('clinics.form',[
                            'URL' => route('clinics.store'),
                            'method' => 'POST',
                            'clinic' => $_clinic
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-4 d-xl-block d-none">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="text-primary font-weight-bold m-0">Pacientes por Sede</h6>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div> --}}
</div>
@endsection

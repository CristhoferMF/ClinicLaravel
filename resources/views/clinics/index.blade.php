@extends('layouts.app')

@section('scripts')
    <script src="{{asset('/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#clinics-table').DataTable();
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Sedes</h1>
    <p class="mb-4">
        Administra las sedes de la clinica. Añade una nueva, actualiza sus datos o altera el estado de la misma.
    </p>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Agregar Sede</h6>
                </div>
                <div class="card-body">
                    @include('clinics.form')
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Pacientes por Sede</h6>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold">Nuestras Sedes</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="clinics-table">
                            <thead class="thead-default">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clinics as $clinic)
                                        <tr>
                                        <td scope="row">{{$clinic->id}}</td>
                                        <td>{{$clinic->name}}</td>
                                        <td>{{$clinic->description}}</td>
                                        <td>{{$clinic->status}}</td>
                                        <td style="min-width:140px" width="140px" align="center">
                                                <button type="button" class="btn btn-sm btn-warning text-black-50">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                    </button>
                                                <button type="button" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt    "></i>
                                                    </button>
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
@endsection
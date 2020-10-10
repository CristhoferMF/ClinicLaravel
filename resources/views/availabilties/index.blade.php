@extends('layouts.app')

@section('content')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Disponibilidad</h1>
        <a href="{{route('doctor.availabilities.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow">Agregar disponibilidad</a>
  </div>

    <div class="row">
        <div class="col-12">
            @component('components.card')
                @slot('title','Lista de disponibilidades')
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Doctor</th>
                                    <th>Sede</th>
                                    <th>Especialidad</th>
                                    <th>Día</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th>Max. Pacientes</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de fin</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm my-2" placeholder="Nombre de doctor">
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm my-2">
                                            <option value="">Sede</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm my-2" placeholder="Especialidad">
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm my-2">
                                            <option value="">Día</option>
                                            <option value="0">Domingo</option>
                                            <option value="1">Lunes</option>
                                            <option value="2">Martes</option>
                                            <option value="3">Miercoles</option>
                                            <option value="4">Jueves</option>
                                            <option value="5">Viernes</option>
                                            <option value="6">Sabado</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endslot
            @endcomponent
        </div>
    </div>

@endsection
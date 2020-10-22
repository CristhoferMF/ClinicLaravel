@extends('layouts.app')

@section('scripts')
    <script>
        $('#availability-table').DataTable({
            processing: true,
            serverSide: true,
            ajax : "{{route('availabilities.datatables.data')}}",
            columnDefs: [
                { width : "115px", targets: 12 },
            ],
            columns: [
                { data: 'id' , name : 'availabilities.id' },
                { data: 'doctor.document_number' , name : 'doctor.document_number' },
                { data: 'doctor.full_name' , name : 'doctor.last_name' },
                { data: 'specialty.clinic_name' , name : 'specialty.clinic_id' },
                { data: 'specialty.name' , name : 'specialty.name' },
                { data: 'day' , name : 'day' },
                { data: 'from_hour' , name : 'from_hour' },
                { data: 'to_hour' , name : 'to_hour' },
                { data: 'max_patients' ,name : 'max_patients'},
                { data: 'from_date' , name : 'from_date' },
                { data: 'to_date' ,name : 'to_date'},
                { data: 'status' ,name : 'availabilities.status'},
                { data: 'actions' , name: 'actions', orderable: false, searchable: false},
            ]
        })
    </script>
@endsection


@section('content')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Disponibilidad</h1>
        <a href="{{route('availabilities.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow">Agregar disponibilidad</a>
  </div>

    <div class="row">
        <div class="col-12">
            @component('components.card')
                @slot('title','Lista de disponibilidades')
                @slot('body')
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped" id="availability-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Doctor N° Doc.</th>
                                    <th>Doctor</th>
                                    <th>Sede</th>
                                    <th>Especialidad</th>
                                    <th>Día</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th>Max. Pacientes</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
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
                                        <input type="text" class="form-control form-control-sm my-2" placeholder="Número de documento">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm my-2" placeholder="Nombre de doctor">
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm my-2">
                                            <option value="">SEDES</option>
                                            @foreach ($clinics as $clinic)
                                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                            @endforeach
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
                                    <td>
                                        <select name="" class="form-control form-control-sm my-2">
                                            <option value="">Estado</option>
                                            <option value="active">Activo</option>
                                            <option value="inactive">Inactivo</option>
                                        </select>
                                    </td>
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
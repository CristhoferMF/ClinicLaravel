@extends('layouts.app')

@section('scripts')
    <script>
        $(function(){
            $('#doctors-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('doctors.datatables.data')}}",
                columnDefs: [
                    { width : "7rem", targets: 2 },
                    { width : "4rem", targets: 5 },
                    { width : "15%", targets: 6 },
                    { width : "115px", targets: 7 },
                ],
                columns: [
                    { data: 'id' , name: 'id'},
                    { data: 'document_type.name' , name: 'document_type.name'},
                    { data: 'document_number' , name: 'document_number'},
                    { data: 'name' , name: 'name'},
                    { data: 'gender' , name: 'gender'},
                    { data: 'status' , name: 'status'},
                    { data: 'created_at' , name: 'created_at'},
                    { data: 'actions' , name: 'actions', orderable: false, searchable: false},
                ]
            })
        })
        
    </script>
@endsection

@section('content')
    
    <h1 class="h3 mb-4 text-gray-800">Doctores</h1>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary m-0">Tabla de doctores</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered" id="doctors-table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo Documento</th>
                                    <th>N° Documento</th>
                                    <th>Apellidos y nombres</th>
                                    <th>Genero</th>
                                    <th>Estado</th>
                                    <th>Fecha de creación</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Filtros:</th>
                                        <td></td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm my-2" placeholder="N° Documento"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm my-2" placeholder="Apellidos y Nombres"/>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select name="" class="form-control form-control-sm my-2">
                                                <option value="">Estado</option>
                                                <option value="active">Activo</option>
                                                <option value="inactive">Inactivo</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="offset-md-1 col-md-10">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Agregar doctor</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-md-block text-center d-none">
                            <img class="img-fluid px-3 px-sm-4 mt-4" style="max-height: 12rem" 
                            src={{asset('img/undraw_doctor_kw5l.svg')}} alt="">
                        </div>
                        <div class="col-md-6">
                            @include('doctors.form',[
                                'URL' => route('doctors.store'),
                                'method' => 'POST',
                                'doctor' => $_doctor,
                            ])
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
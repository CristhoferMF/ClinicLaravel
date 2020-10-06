@extends('layouts.app')

@section('scripts')
<script>
    $(function() {
        $('.filter select').change(function(){
            table.draw();
        });

        var table = $('#table-specialties').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('specialties.datatables.data')}}",
                data: function (d){
                }
            },
            columnDefs: [
                { width : "10rem", targets: 1 },
                { width : "15%", targets: 4 },
                { width : "120px", targets: 5 },
            ],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'clinic.name', name: 'clinic.name' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'created_at', name: 'created_at',orderable: false,searchable: false },
                { data: 'action' , name: 'action',orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection

@section('content')
    <h1 class="h3 text-gray-800 mb-4">Especialidades</h1>
    
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 shadow">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Todas las especialidades</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered" id="table-specialties">
                            <thead class="">
                                <tr>
                                    <th>ID</th>
                                    <th>Sede</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Fecha de creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot class="">
                                <tr class="filter">
                                    <th>Filtrar</th>
                                    <th>
                                        <select name="" id="filter-select-clinic" class="form-control form-control-sm my-2">
                                            <option value="">SEDES</option>
                                            @foreach ($clinics as $clinic)
                                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>
                                        <input type="text" class="form-control form-control-sm my-2" placeholder="Especialidad">
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Agregar Especialidad</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 d-lg-block text-center d-none">
                            <img class="img-fluid px-3 px-sm-4 mt-4" style="max-height: 12rem" 
                            src={{asset('img/undraw_medicine_b1ol.svg')}} alt="">
                        </div>
                        <div class="col-lg-8">
                            @include('specialties.form',[
                                'method' => 'POST',
                                'URL' => route('specialties.store'),
                                'specialty' => $specialty
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
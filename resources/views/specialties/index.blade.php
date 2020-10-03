@extends('layouts.app')


@section('scripts')
<script src="{{asset('/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(function() {
        $('#table-specialties').DataTable({
            processing: true,
            responsive:true,
            serverSide: true,
            ajax: '/admin/especialidades/datatables',
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

@section('styles')
<link rel="stylesheet" href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}">
@endsection


@section('content')
    <h1 class="h3 text-gray-800 mb-4">Especialidades</h1>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold m-0">Agregar Especialidad</h6>
                </div>
                <div class="card-body">
                    @include('specialties.form',[
                        'method' => 'POST',
                        'URL' => route('specialties.store'),
                        'specialty' => $specialty
                    ])
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6"></div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
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
                                <tr>
                                    <th>ID</th>
                                    <th>Sede</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Fecha de creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
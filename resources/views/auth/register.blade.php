@extends('layouts.app_without_navbar')
@section('body-class','bg-gradient-primary')

@section('scripts')
    <script src="{{asset('/js/components/form-date-picker.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="card border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="d-flex">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">

                    </div>
                    <div class="col-lg-7">
                        <div class="px-3 py-5 p-sm-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900">¡Registrate para empezar!</h1>
                                <p class="text-justify mb-4 mt-2">Regístrate y podrás visualizar la disponibilidad de los médicos, tus citas históricas y además reservar y pagar tu consulta en línea. 
                                    Recuerda que tus datos estarán resguardados por nosotros.</p>
                            </div>
                            <div>
                                @include('auth.form.register')
                            </div>
                            <hr>
                            <div class="text-center my-3">
                                <a href="{{route('login')}}" class="small">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    Regresar a Iniciar Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('scripts')
    <script src="{{asset('js/form-availabilities.js')}}"></script>
@endsection

@section('content')
    
    @component('components.title_content')
        @slot('title','Disponibilidad')
    @endcomponent

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            @component('components.card')
                @slot('title','Aañadir disponibilidades')
                @slot('body')
                <div id="example">
                    <div class="spinner-border text-primary my-4" role="status" style="width: 3rem; height: 3rem;">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </div>    
                @endslot
            @endcomponent
        </div>
    </div>

<input type="hidden" value="{{$doctors}}" id="doctors-json">
<input type="hidden" value="{{$clinics}}" id="clinics-json">
<input type="hidden" value="{{route('clinics.specialties',['_id'])}}" id="URL_SPECIALTIES">
<input type="hidden" value="{{route('availabilities.store')}}" id="AVAILABILITIES_STORE">
<input type="hidden" value="{{route('doctors.availabilities.index',['_doctor'])}}" id="DOCTORS_AVAILABILITIES_INDEX">
@endsection
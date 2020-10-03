<form action="{{$URL}}" method="POST">
    @csrf
    @method($method)
    <div class="form-group row">
        <div class="col-md-5">
            <div class="form-group">
                <select class="form-control" name="clinic_id" id="">
                    <option selected value="">Sede</option>
                    @foreach ($clinics as $clinic)
                        <option value="{{$clinic->id}}" {{ (old('clinic_id',$specialty->clinic_id) == $clinic->id) ? ' selected ' : '' }}>{{$clinic->id}} - {{$clinic->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
              <input type="text"
            class="form-control" name="name" id="" placeholder="Nombre de especialidad" value="{{old('name',$specialty->name)}}">  
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <label for="description">Descripción de la especialidad:</label>
        <textarea name="description" placeholder="..." id="description" cols="5" rows="5" class="form-control">{{old('description',$specialty->description)}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col text-right">
            <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50"><i class="fa fa-check" aria-hidden="true"></i></span>
                <span class="text">Guardar Especialidad</span></button>
        </div>
    </div>
    @if ($errors->any())
        <div class="form-group row">
            <div class="col">
                @component('bootstrap::alert',[ 'type' => 'danger'])
                    @foreach ($errors->all() as $error)
                        {{$error}} <br>
                    @endforeach
                @endcomponent
            </div>
        </div>
    @endif
</form>
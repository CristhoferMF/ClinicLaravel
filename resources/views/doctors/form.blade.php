<form action="{{$URL}}" method="POST">
    @method($method)
    @csrf
    <div class="form-group row">
        <div class="input-group col-sm-6 mb-3 mb-sm-0">
            <select type="text" class="form-control small" name="document_type_id">
                <option value="">Tipo de Documento</option>
                @foreach ($documentTypes as $document)
                    <option value="{{$document->id}}" {{ old('document_type_id',$doctor->documentType->id) == $document->id ? 'selected' : '' }}>{{$document->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group col-sm-6">
            <input type="text" class="d-block form-control" maxlength="15"
                value="{{ old('document_number',$doctor->document_number) }}" name="document_number" placeholder="N. de documento">
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <input type="text" name="last_name" class="form-control" 
                placeholder="Apellidos *" value="{{old('last_name',$doctor->last_name)}}" >
        </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <input type="text" name="first_name" class="form-control" 
                placeholder="Nombres *" value="{{old('first_name',$doctor->first_name)}}">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <select class="form-control" name="gender">
                <option value="">Genero *</option>
                <option value="M" {{ old('gender',$doctor->gender) == 'M' ? 'selected' : '' }}>Hombre</option>
                <option value="F" {{ old('gender',$doctor->gender) == 'F' ? 'selected' : '' }}>Mujer</option>
            </select>
        </div>
        <div class="col-md-6">
            <select name="status" class="form-control">
                <option value="">Estado *</option>
                <option value="inactive" {{ old('status',$doctor->status) == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                <option value="active"   {{ old('status',$doctor->status) == 'active' ? 'selected' : '' }}>Activo</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-6 col-md-6 text-right">
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </div>
    </div>
</form>

@if ($errors->any())
    @component('bootstrap::alert',[ 'type' => 'danger','class' => 'alert-sm'])
        <span class="font-weight-bold small">({{$errors->count()}} errores restantes)</span> - {{$errors->first()}}
    @endcomponent
@endif
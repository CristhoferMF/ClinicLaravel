<form action="{{$URL}}" method="POST">
    @csrf
    @method($method)

    <div class="form-group row">
        <div class="col-md-4">
            <select name="status" id="" class="form-control @error('status') is-invalid @enderror">
                @if ($method == 'POST')
                    <option value="">Estado *</option>
                @endif
                <option value="active"    {{ (old('status',$clinic->status) == 'active') ? 'selected' : '' }}>Activo</option>
                <option value="inactive"  {{ (old('status',$clinic->status) == 'inactive') ? 'selected' : '' }}>Inactivo</option>
                <option value="pending"   {{ (old('status',$clinic->status) == 'pending') ? 'selected' : '' }}>Pendiente</option>
            </select>
            @error('status')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-8">
            <p class="m-0 small">
                Los pacientes solo podrán seleccionar una cita en una sede que este <strong>activa</strong>.
            </p>
        </div>
    </div>
    <div class="form-group row">
        <div class="input-group col-md-6 col-12 mb-3 mb-md-0">
            <input type="text" name="name" value="{{old('name',$clinic->name)}}"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Nombre de Sede *">
            @error('name')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group col-md-6 col-12">
            <input type="text" name="address" value="{{old('address',$clinic->address)}}" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección *">
            @error('address')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="input-group col-12">
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Descripción" id="" rows="3">{{old('description',$clinic->description)}}</textarea>
            @error('description')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="input-group col-12">
            @if ($errors->any())
                <div>
                    <small class="text-danger">* Asegure de completar los campos requeridos</small>
                </div>
            @endif
            <button class="btn btn-success btn-icon-split ml-auto">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">
                    Guardar Cambios
                </span>
            </button>
        </div>
    </div>
</form>

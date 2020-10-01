<form method="POST" class="form-register">
    @csrf
    <div class="form-group row">
        <div class="input-group col-sm-6 mb-3 mb-sm-0">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-id-card"></i>
                </span>
            </div>
            <select type="text" class="form-control small @error('document_type') is-invalid @enderror" name="document_type">
                <option value="">Tipo de Documento</option>
                @foreach ($documentTypes as $document)
                    <option value="{{$document->id}}" {{ old('document_type') == $document->id ? 'selected' : '' }}>{{$document->name}}</option>
                @endforeach
            </select>
            @error('document_type')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group col-sm-6">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-hashtag"></i>
                </span>
            </div>
            <input type="text" class="d-block form-control @error('document_number') is-invalid @enderror" 
                value="{{ old('document_number') }}" name="document_number" placeholder="N. de documento">
            @error('document_number')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="input-group col-sm-6 mb-3 mb-sm-0">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
            </div>
            <input type="text" class="d-block form-control @error('father_last_name') is-invalid @enderror"
                value="{{old('father_last_name')}}"
                name="father_last_name" placeholder="Apellido Paterno" />
            @error('father_last_name')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group col-sm-6">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
            </div>
            <input type="text" class="d-block form-control @error('mother_last_name') is-invalid @enderror"
                value="{{old('mother_last_name')}}"
                name="mother_last_name" placeholder="Apellido Materno" />
            @error('mother_last_name')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="input-group col-sm-6 mb-3 mb-sm-0">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
            </div>
            <input type="text" class="d-block form-control @error('first_name') is-invalid @enderror"
                value="{{old('first_name')}}"
                name="first_name" placeholder="Nombres" />
            @error('first_name')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group col-sm-6">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </span>
            </div>
            
            <div id="datepicker-container" 
                data='@json([ 'oldValue' => old('born_date'), 'isInvalid' => $errors->has('born_date') ])'>
                <input type="text" class="form-control" placeholder="Fecha de Nacimiento"> 
            </div>
            @error('born_date')
                <div class="invalid-feedback" style='display:block' role="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="input-group col-sm-6 mb-3 mb-sm-0">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-phone"></i>
                </span>
            </div>
            <input type="text" class="d-block form-control @error('phone') is-invalid @enderror"
                value="{{old('phone')}}"
                name="phone" placeholder="Celular" />
            @error('phone')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group col-sm-6">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-venus-mars"></i>
                </span>
            </div>
            <select class="form-control  @error('gender') is-invalid @enderror" name="gender" id="">
                <option value="">Genero</option>
                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Hombre</option>
                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Mujer</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="input-group col-12">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-at"></i>
                </span>
            </div>
            <input type="email" class="d-block form-control @error('email') is-invalid @enderror"
                value="{{old('email')}}"
                name="email" placeholder="Correo Electrónico" />
            @error('email')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="input-group col-sm-6 mb-3 mb-sm-0">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="d-block form-control @error('password') is-invalid @enderror"
                name="password" placeholder="Contraseña" autocomplete="new-password" />
            @error('password')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group col-sm-6">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="d-block form-control"
                name="password_confirmation" placeholder="Confirmar Contraseña" autocomplete="new-password"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 mt-sm-3 mt-0">
            <button class="btn btn-primary btn-block">Crear Cuenta</button>
        </div>
    </div>
</form>

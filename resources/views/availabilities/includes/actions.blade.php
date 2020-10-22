<div class="d-flex justify-content-between">
    <a href="{{route('doctors.availabilities.index', [$doctor['id']])}}" target="_blank" class="btn btn-sm btn-success ml-2">
        <i class="fas fa-search"></i>
    </a>
    <a href="{{route('availabilities.edit', [$id])}}" class="btn btn-sm btn-warning text-black-50" >
        <i class="fa fa-arrow-down" aria-hidden="true"></i>
    </a>
    <form action="{{route('availabilities.destroy', [$id])}}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
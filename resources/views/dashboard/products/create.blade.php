@extends('dashboard.index')

@section('title')
    Categories
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> Categories </li>
@endsection


@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-primary"> Back </a>
    </div>




    
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf





      
        <input value='[{"value":"foo", "editable":false}, {"value":"bar"}]' name="tags"> 


        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Create </button>
        </div>
    </form>


@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

<script>
// The DOM element you wish to replace with Tagify
var input = document.querySelector('input[name=tags]');

// initialize Tagify on the above input node reference
new Tagify(input)

</script>
@endpush
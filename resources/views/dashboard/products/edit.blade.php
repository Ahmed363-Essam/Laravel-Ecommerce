@extends('dashboard.index')

@section('title')
    Products
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> Edit Products </li>
@endsection


@section('content')
    <div class="mb-5">
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary"> Back </a>
    </div>

    <form action="{{ route('products.update', $products->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}


        <div class="form-group">
            <label for=""> Product Name </label>

            <input type="text" class="form-control" value="{{ $products->name }}" name="name" id="">

        </div>


        <div class="form-group">

            <label for=""> Primary Category </label>

            <select name="cat_id" class="form-control form-select">

                <option value="">Primary Category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

        </div>

        <div class="form-group">
            <label for=""> Description </label>

            <textarea name="description" name="description" class="form-control" id="" cols="10" rows="5"> {{ $products->description }} </textarea>

        </div>

        <div class="form-group">
            <label for=""> Price </label>

            <input type="text" class="form-control" value="{{ $products->price }}" name="price" id="">

        </div>

        <div class="form-group">
            <label for=""> Compare Price </label>

            <input type="text" class="form-control" value="{{ $products->compare_price }}" name="compare_price" id="">

        </div>


        <div class="form-group">
          <label for=""> Tags  </label>

          <input type="text" class="form-control" value="{{ $tages }}" name="tags" id="">

      </div>




        <div class="form-group">

            <label for=""> Status </label>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active"   {{ ($products->status=="active")? "checked" : "" }}>
                <label class="form-check-label" for="flexRadioDefault1">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"  value="draft"   {{ ($products->status=="draft")? "checked" : "" }}>
                <label class="form-check-label" for="flexRadioDefault2">
                    Draft
                </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="status" id="flexRadioDefault3"  value="archived"   {{ ($products->status=="archived")? "checked" : "" }}>
              <label class="form-check-label" for="flexRadioDefault3">
                  Archived
              </label>
          </div>

        </div>


      



        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update </button>
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

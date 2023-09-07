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

    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for=""> Category Name </label>
            <input type="text" name="name" class="form-control">
            @error('name')
              <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>



        <div class="form-group">
            <label for=""> Category Parent </label>
            <select name="parent_id" class="form-control">
                <option hidden value=""> Primary Category </option>

                @forelse ($parents as $parent)
                    <option value="{{ $parent->id }}"> {{ $parent->name }} </option>
                @empty
                    <option value=""> Sorry : There Is No Options </option>
                @endforelse
            </select>

            @error('parent_id')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
            <label for=""> Description </label>
            <textarea name="description" class="form-control" id="" cols="10" rows="5"></textarea>

            @error('description')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>


        <div class="form-group">
            <label for=""> Category Image </label>
            <input type="file" name="image" id="" class="form-control">

            
            @error('image')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active">
            <label class="form-check-label" for="flexRadioDefault1">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" checked value="inactive">
            <label class="form-check-label" for="flexRadioDefault2">
                Archived
            </label>
        </div>

        @error('status')
        <p class="text-danger">{{ $message }}</p>
      @enderror

        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Save </button>
        </div>
    </form>
@endsection

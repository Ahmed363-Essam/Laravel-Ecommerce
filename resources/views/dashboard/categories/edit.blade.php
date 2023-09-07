@extends('dashboard.index')

@section('title')
    Categories
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> Edit Categories </li>
@endsection


@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-primary"> Back </a>
    </div>

    <form action="{{ route('categories.update',$categories->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for=""> Category Name </label>
            <input type="text" name="name" class="form-control" value=" {{ $categories->name }} ">

            @error('name')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
            <label for=""> Category Parent </label>
            <select name="parent_id" class="form-control">
              <option  hidden selected value="{{ $categories->id }}"> {{ $categories->name }} </option>
                @forelse ($parents as $parent)
                    <option   value="{{ $parent->id }}"> {{ $parent->name }} </option>
                @empty
                    <option value=""> Sorry : There Is No Options </option>
                @endforelse
            </select>

            
            @error('parent_id')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
            <label for=""> Description  </label>
            <textarea name="description"  class="form-control"  id="" cols="10" rows="5"> {{ $categories->description }} </textarea>
        </div>


        <div class="form-group">
            <label for=""> Category Image  </label>
            <input type="file" name="image" id=""  class="form-control">

            @error('image')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1"  value="active" {{ ($categories->status=="active")? "checked" : "" }}  >
            <label class="form-check-label" for="flexRadioDefault1">
               Active
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"  value="inactive" {{ ($categories->status=="inactive")? "checked" : "" }} >
            <label class="form-check-label" for="flexRadioDefault2">
              Archived
            </label>
          </div>
          @error('status')
          <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Edit </button>
        </div>
    </form>
@endsection

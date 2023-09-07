@extends('dashboard.index')

@section('title')
    Tags
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> Tags </li>
@endsection


@section('content')

<x-alert msg='success'> </x-alert>

<x-alert msg='info'> </x-alert>

<x-alert msg='danger'> </x-alert>


    <div class="mb-5">
        <a href="{{ route('tags.create') }}" class="btn btn-sm btn-outline-primary"> Create  </a>

        <a href="{{ route('products.trashed') }}" class="btn btn-sm btn-outline-danger"> Trashed Tags  </a>
    </div>


    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <input type="text" name="name" placeholder="Name" class="form-control mx-2"  />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tags Name</th>
                <th>Tags Slug</th>
   

                <th>Created At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>

            @forelse($tags as $tag)
            <tr>

                <td>{{ $tag->id }}</td>
       
                <td> <a href="{{ route('tags.show',$tag->id) }}"> {{ $tag->name }} </a> </td>
                <td>{{ $tag->slug }}</td>

       
                <td>{{ $tag->created_at }}</td>
                
                <td>
                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('tags.destroy',$tag->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger"> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9">No products defined.</td>
            </tr>
            @endforelse

        </tbody>

    </table>
 
@endsection

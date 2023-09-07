@extends('dashboard.index')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush

@section('title')
    Categories
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> Categories </li>
@endsection


@section('content')

<x-alert msg='success'> </x-alert>

<x-alert msg='info'> </x-alert>

<x-alert msg='danger'> </x-alert>


    <div class="mb-5">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary"> Create  </a>

        <a href="{{ route('trashed') }}" class="btn btn-sm btn-outline-danger"> Trashed Categories  </a>
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

    <table class="table" id="datatable">
        <thead>
            <tr>
                <th> </th>
                <th> ID </th>
                <th> Name </th>
                <th> Parent </th>
                <th> Status </th>
                <th> Created At </th>
                <th>  </th>
                <th>  </th>
         
            </tr>
        </thead>
        <tbody>


            @forelse ($categories as $category)
                <tr>
                    <td> <img style="width: 100px;height: 100px;" src="{{ asset('/assets').'/'.$category->image.'/'.$category->image }}" alt="" srcset=""> </td>
                    <td> {{ $category->id }} </td>
                    <td> <a href="{{ route('categories.show',$category->id) }}"> {{ $category->name }} </a>  </td>
                    <td> {{ $category->name }} </td>
                    <td> {{ $category->status }} </td>
                    <td> {{ $category->created_at }} </td>
                    <td>
                        <a href="{{ route('categories.edit',  $category->id  ) }}" class="btn btn-sm btn-outline-success"> Edit
                        </a>
                    </td>


                    <td>
                    <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger"> Delete
                        </button>
                    </form>
           
                    </td>
                </tr>
            @empty

                <tr>
                    <td colspan="7"> No Category To Show </td>
                </tr>
            @endforelse

        </tbody>

    </table>
    
    {{ $categories->links() }}
@endsection


@push('scripts')

@endpush
@extends('dashboard.index')

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
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary"> Create </a>

        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-success"> Back </a>
    </div>


    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <input type="text" name="name" placeholder="Name" class="form-control mx-2" />
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
                <th> </th>
                <th> ID </th>
                <th> Name </th>
                <th> Parent </th>
                <th> Status </th>
                <th> Created At </th>
                <th> </th>
                <th> </th>
                <th>  </th>
            </tr>
        </thead>
        <tbody>


            @forelse ($categories as $category)
                <tr>
                    <td> <img style="width: 100px;height: 100px;"
                            src="{{ asset('/assets') . '/' . $category->image . '/' . $category->image }}" alt=""
                            srcset=""> </td>
                    <td> {{ $category->id }} </td>
                    <td> {{ $category->name }} </td>
                    <td> {{ $category->parent_id }} </td>
                    <td> {{ $category->status }} </td>
                    <td> {{ $category->created_at }} </td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">
                            Edit
                        </a>
                    </td>


                    <td>
                        <form action="{{ route('force') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger"> Force Delete
                            </button>
                        </form>

                    </td>


                    <td>
                        <form action="{{ route('restore') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <button type="submit" class="btn btn-sm btn-outline-success"> Restore
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

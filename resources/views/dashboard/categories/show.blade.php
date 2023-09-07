@extends('dashboard.index')

@section('title')
    Products
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> Products </li>
@endsection


@section('content')

<x-alert msg='success'> </x-alert>

<x-alert msg='info'> </x-alert>

<x-alert msg='danger'> </x-alert>


    <div class="mb-5">
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary"> Create  </a>

        <a href="{{ route('products.trashed') }}" class="btn btn-sm btn-outline-danger"> Trashed Products  </a>
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
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>

            @forelse($products as $product)
            <tr>
                <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->cats1->name }}</td>
                <td>{{ $product->store->name }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('products.destroy',$product->id) }}" method="post">
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
    
    {{ $products->links() }}
@endsection

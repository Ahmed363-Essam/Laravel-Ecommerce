@extends('dashboard.index')

@section('title')
    Products Tages
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> Tages </li>
@endsection


@section('content')

<x-alert msg='success'> </x-alert>

<x-alert msg='info'> </x-alert>

<x-alert msg='danger'> </x-alert>


    <div class="mb-5">
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary"> Create  </a>

        <a href="{{ route('products.trashed') }}" class="btn btn-sm btn-outline-danger"> Trashed Products  </a>
    </div>


<h2 class="h1"> {{ $products->name }} </h2>
    <table class="table">
        <thead>
            <tr>
              
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
          
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>

            @forelse($tages as $tag)
            <tr>
           
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->slug }}</td>

            </tr>
            @empty
            <tr>
                <td colspan="9">No products defined.</td>
            </tr>
            @endforelse

        </tbody>

    </table>
    

@endsection

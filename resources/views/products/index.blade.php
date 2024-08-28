@extends('layout')

@section('content')
<h2>Products</h2>
<a href="{{ url('/products/create') }}" class="btn btn-primary">Add Product</a>
<table class="table mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Product Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->name }}</td>
            <td>


            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

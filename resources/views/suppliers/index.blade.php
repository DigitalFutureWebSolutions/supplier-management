@extends('layout')

@section('content')
<h2>Suppliers</h2>
<a href="{{ url('/suppliers/create') }}" class="btn btn-primary">Add Supplier</a>
<table class="table mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Supplier Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{ $supplier->id }}</td>
            <td>{{ $supplier->name }}</td>
            <td>
                <a href="{{ url('suppliers/'.$supplier->id.'/edit') }}" class="btn btn-warning">Edit</a>
                <form action="{{ url('suppliers/'.$supplier->id) }}" method="POST" style="display:inline;">
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
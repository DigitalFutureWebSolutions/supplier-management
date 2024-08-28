@extends('layout')

@section('content')
<h2>Edit Supplier</h2>
<form action="{{ url('suppliers/'.$supplier->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Supplier Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection

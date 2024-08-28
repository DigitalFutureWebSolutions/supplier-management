@extends('layout')

@section('content')
<h2>Add Category</h2>
<form action="{{ url('/categories') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
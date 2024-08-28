@extends('layout')

@section('content')
<h2>Edit Category</h2>
<a href="{{ route('categories.index') }}" class="btn btn-secondary mb-3">Back</a>
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection

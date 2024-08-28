@extends('layout')

@section('content')
<h2>Edit Record</h2>
<form action="{{ route('records.update', $record->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="supplier_id">Supplier</label>
        <select name="supplier_id" id="supplier_id" class="form-control" required>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ $record->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $record->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="form-control" required>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $record->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $record->quantity }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection

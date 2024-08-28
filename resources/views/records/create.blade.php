@extends('layout')

@section('content')
<h2>Add Record</h2>
<form action="{{ route('records.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="supplier_id">Supplier</label>
        <select name="supplier_id" id="supplier_id" class="form-control" required>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="form-control" required>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection

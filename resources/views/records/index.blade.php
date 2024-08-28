@extends('layout')

@section('content')
<h2>Records</h2>
<a href="{{ url('/records/create') }}" class="btn btn-primary">Add Record</a>

<!-- Supplier and Date Filter Form -->
<form action="{{ url('/records') }}" method="GET" class="mt-3">
    <div class="form-group">
        <label for="supplier">Filter by Supplier:</label>
        <select name="supplier_id" id="supplier" class="form-control" onchange="this.form.submit()">
            <option value="">All Suppliers</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group mt-3">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
    </div>
    
    <div class="form-group mt-3">
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
    <a href="{{ url('/records') }}" class="btn btn-secondary mt-3">Clear Filters</a>
</form>

<!-- Print PDF Button with dynamic filter parameters -->
<form action="{{ route('records.generatePdf') }}" method="POST">
    @csrf
    <input type="hidden" name="supplier_id" value="{{ request('supplier_id') }}">
    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
    <button type="submit" class="btn btn-danger mt-3">Print PDF</button>
</form>

<table class="table mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Supplier</th>
            <th>Category</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Created Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->supplier ? $record->supplier->name : 'N/A' }}</td>
            <td>{{ $record->category ? $record->category->name : 'N/A' }}</td>
            <td>{{ $record->product ? $record->product->name : 'N/A' }}</td>
            <td>{{ $record->quantity }}</td>
            <td>{{ $record->created_at ? $record->created_at->format('Y-m-d') : 'N/A' }}</td>
            <td>
                <a href="{{ url('records/'.$record->id.'/edit') }}" class="btn btn-warning">Edit</a>
                
                <form action="{{ url('records/'.$record->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        
        <!-- Row for Total Quantity -->
        <tr>
            <td colspan="4" class="text-right"><strong>Total Quantity:</strong></td>
            <td><strong>{{ $totalQuantity }}</strong></td>
            <td colspan="2"></td> <!-- Empty cells for alignment -->
        </tr>
    </tbody>
</table>
@endsection
